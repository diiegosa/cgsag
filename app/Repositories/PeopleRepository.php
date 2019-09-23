<?php namespace App\Repositories;

use App\Person;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Repositories\InterestsRepository;

class PeopleRepository
{
    const STORED_SUCCESS_MSG = "Cadastrado com Sucesso!";
    const UPDATED_SUCCESS_MSG = "Atualizado com Sucesso!";
    const DELETED_SUCCESS_MSG = "Deletado com Sucesso!";
    const DELETED_ERROR_MSG = "Ops! Este Item não pode ser deletado!";
    const UNIQUE_ERROR_MSG = "Ops! Você já possui um Registro com este(s) valor(es)";
    const FATHER_ERROR_MSG = "Ops! Este Item não pode ser deletado por estar associado a um ou mais itens do Sistema.";
    const DEFAULT_ERROR_MSG = "Contate o Administrador.";
    const PERPAGE = 15;
    const MODEL_DIR = 'people';
    const STORAGE_DIR = '/storage/';

    protected static $response = ['success' => false, 'msg' => '', 'model' => null];

    public function __construct(Person $person, InterestsRepository $interestsRepository)
    {
        $this->model = $person;
        $this->interestsRepository = $interestsRepository;
    }

    public function store(Array $input)
    {   
        try {
            DB::beginTransaction();
            // Linhas abaixo relacionadas ao arquivo
            $fileName = uniqid(date('HisYmd'));
            $fileName = "{$fileName}.{$input['photo']->extension()}";  
            
            if($input['photo']->storeAs(self::MODEL_DIR, $fileName)) {
                $input['file_name'] = $fileName;
                $input['file_mime'] = $input['photo']->getMimeType();
                $input['original_filename'] = $input['photo']->getClientOriginalName();
                $input['file_path_to_show'] = self::STORAGE_DIR.self::MODEL_DIR."/{$fileName}";

                // Salva os registros de pessoa
                self::$response['model'] = $this->model->create($input);
                // As quatro próximas linhas fazem a relação com os interesses (e salvam interesses novos)
                $input['interests_select'] = array_filter($input['interests_select']);
                $input['interest_inputs'] = array_key_exists('interest_inputs', $input) ? $this->interestsRepository->storeOrGetIfExists($input['interest_inputs']) : [];
                $input['interests'] = array_merge($input['interests_select'],$input['interest_inputs']);
                self::$response['model']->interests()->attach(array_unique($input['interests']));
                
                self::$response['success'] = true;
                self::$response['msg'] = self::STORED_SUCCESS_MSG;
                DB::commit();
            } else {
                throw new Exception("Falha ao fazer upload da foto");
            }
        } catch (\Exception $e) {
            DB::rollback();
            self::$response['success'] = false;
            if ($e->getCode() == 23000) {
                self::$response['msg'] = self::UNIQUE_ERROR_MSG;
            } else {
                self::$response['msg'] = '('.$e->getCode().') '. self::DEFAULT_ERROR_MSG;
            }
        }

        return self::$response;
    }

    public function update(Array $input, $id)
    {
        try {
            DB::beginTransaction();
            $person = $this->model->findOrFail($id);
            
            // Linhas abaixo relacionadas ao arquivo
            if(array_key_exists('photo', $input)) {
                Storage::delete(self::MODEL_DIR."/{$person->file_name}"); 
                $fileName = uniqid(date('HisYmd'));
                $fileName = "{$fileName}.{$input['photo']->extension()}";
                $input['file_name'] = $fileName;
                $input['file_mime'] = $input['photo']->getMimeType();
                $input['original_filename'] = $input['photo']->getClientOriginalName();
                $input['file_path_to_show'] = self::STORAGE_DIR.self::MODEL_DIR."/{$fileName}";
                
                if(!$input['photo']->storeAs(self::MODEL_DIR, $fileName)) throw new Exception("Falha ao fazer upload da nova foto");
            }
            // Realizando update
            $person->fill($input);
            $person->save($input);
            
            // Realizando update na relação com os interesses
            $input['interests_select'] = array_filter($input['interests_select']);
            $input['interest_inputs'] = array_key_exists('interest_inputs', $input) ? $this->interestsRepository->storeOrGetIfExists($input['interest_inputs']) : [];
            $input['interests'] = array_merge($input['interests_select'],$input['interest_inputs']);
            $person->interests()->sync([]);
            $person->interests()->attach(array_unique($input['interests']));
            
            self::$response['model'] = $person;
            self::$response['success'] = true;
            self::$response['msg'] = self::UPDATED_SUCCESS_MSG;
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            self::$response['success'] = false;
            self::$response['msg'] = '('.$e->getCode().') '. self::DEFAULT_ERROR_MSG;
        }
        return self::$response;
    }

    public function destroy($id)
    {
        $person = $this->model->findOrFail($id);

        try{
            DB::beginTransaction();
            Storage::delete(self::MODEL_DIR."/{$person->file_name}");
            $person->interests()->sync([]);
            $person->delete();
            self::$response['success'] = true;
            self::$response['msg'] = self::DELETED_SUCCESS_MSG;
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            self::$response['success'] = false;
            if($e->getCode() == 23000){
                self::$response['msg'] = self::FATHER_ERROR_MSG;
            }else{
                self::$response['msg'] = '('.$e->getCode().') '.self::DEFAULT_ERROR_MSG;
            }
        }
        return self::$response;
    }
    
    public function all()
    {
        return $this->model->all();
    }
    
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }
}
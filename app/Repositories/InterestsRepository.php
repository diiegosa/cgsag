<?php namespace App\Repositories;

use App\Interest;

class InterestsRepository
{
    public function __construct(Interest $interest)
    {
        $this->model = $interest;
    }

    // Essa função retorna os dados no formato que o multiselect espera
    public function lists($interests = null)
    {
        if(empty($interests)) $interests = $this->model->all(); 
        
        $interests_formated = $interests->map(function ($interest) {
            return array(
                'label' => $interest->name,
                'value' => $interest->id,
                'key' => $interest->id
            ); 
        });
        return $interests_formated->toJson();
    }

    // Essa função salva interesses novos, se já não existirem cadastrados
    public function storeOrGetIfExists(Array $interests)
    {
        $interestsCreatedOrFound = [];
        try {
            $interests = array_filter($interests);
            foreach ($interests as $interest) {
                $interestAlreadyExisted = $this->model->where('name',  strtolower(trim($interest)))->first();
                $interestCreatedOrFound = empty($interestAlreadyExisted) ? $this->model->create([ 'name' => $interest ]) : $interestAlreadyExisted;
                if($interestCreatedOrFound) array_push($interestsCreatedOrFound , $interestCreatedOrFound->id);
            }
        } catch (\Exception $e) {
            throw new Exception("Falha ao salvar novos interesses");
        }
        return $interestsCreatedOrFound;
    }

}
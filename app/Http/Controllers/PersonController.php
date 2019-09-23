<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Repositories\PeopleRepository;
use App\Repositories\InterestsRepository;
use App\Repositories\CitiesRepository;

class PersonController extends Controller
{
    public function __construct(PeopleRepository $repository, InterestsRepository $interestsRepository, CitiesRepository $citiesRepository)
    {
        $this->repository = $repository;
        $this->interestsRepository = $interestsRepository;
        $this->citiesRepository = $citiesRepository;
    }
    
    public function index()
    {
        $people = $this->repository->all();
        return view('people.index', compact('people'));
    }

    public function create()
    {
        $interests = $this->interestsRepository->lists();
        $cities = $this->citiesRepository->lists();
        return view('people.create', compact('interests', 'cities'));
    }

    public function store(StorePersonRequest $request)
    {
        $response = $this->repository->store($request->except('_token'));

        if($response['success']) {
            return redirect('people')->with('success', $response['msg']);
        } else {
            return redirect()->back()->with('error', $response['msg'])->withInput();
        } 
    }

    public function show($id)
    {
        $person = $this->repository->find($id); 
        return view('people.show', compact('person'));
    }

    public function edit($id)
    {
        $person = $this->repository->find($id); 
        $interests = $this->interestsRepository->lists();
        $interestsSelected = empty($person->interests) ? [] : $this->interestsRepository->lists($person->interests); 
        $cities = $this->citiesRepository->lists();
        return view('people.edit', compact('person', 'interests', 'interestsSelected', 'cities'));
    }

    public function update(UpdatePersonRequest $request, $id)
    {
        $response = $this->repository->update($request->except('_token'), $id);

        if($response['success']) {
            return redirect('people')->with('success', $response['msg']);
        } else {
            return redirect()->back()->with('error', $response['msg'])->withInput();
        } 
    }

    public function destroy($id)
    {
        $response = $this->repository->destroy($id);

        if($response['success']) {
            return redirect('people')->with('success', $response['msg']);
        } else {
            return redirect()->back()->with('error', $response['msg'])->withInput();
        }
    }
}

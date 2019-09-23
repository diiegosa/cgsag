<?php namespace App\Repositories;

use App\City;

class CitiesRepository
{
    public function __construct(City $city)
    {
        $this->model = $city;
    }

    public function lists()
    {
        return $this->model->orderBy('name', 'ASC')->pluck('name', 'id');
    }

}
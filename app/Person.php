<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\City;

class Person extends Model
{
    protected $fillable = [
        'name', 
        'email', 
        'date_of_birth', 
        'city', 
        'file_name',
        'file_mime',
        'original_filename',
        'file_path_to_show',
        'city_id'
    ];
    
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'people';

    public function getNameAttribute($name)
    {
        return strtoupper($name); 
    }
    
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower(trim($name));
    }

    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = empty(trim($email)) ? null : strtolower(trim($email));
    }

    public function getDateOfBirthAttribute($date)
    {
        return empty(trim($date)) ? null : Carbon::parse($date)->format('d/m/Y');
    }

    public function setDateOfBirthAttribute($date)
    {
        $date = empty(trim($date)) ? null : Carbon::createFromFormat('d/m/Y', $date)->toDateString();
        $this->attributes['date_of_birth'] = $date;
    }

    public function getCityAttribute($city)
    {
        return strtoupper($city); 
    }
    
    public function setCityAttribute($city)
    {
        $this->attributes['city'] = strtolower(trim($city));
    }

    public function interests()
    {
        return $this->belongsToMany(Interest::class);
    }

    public function cityName()
    {
    	return $this->city()->name;
    }

    private function city()
    {
    	return City::findOrFail($this->city_id);
    }
    
    public function peopleWithTheSameInterest()
    {
        $peopleWithTheSameInterest = [];
        
        // Percorre o array de interesses e de pessoas relacionadas a esses interesses 
        foreach ($this->interests as $interest) {
            foreach ($interest->people as $person) {
                array_push($peopleWithTheSameInterest, $person->name);
            }
        }
        // Retira registros duplicados do array
        $peopleWithTheSameInterest = array_unique($peopleWithTheSameInterest);
        // Retira a própria referência do array
        return array_diff($peopleWithTheSameInterest, array($this->name));
    }

    public function peopleFromTheSameLocality()
    {
        $peopleFromTheSameLocality = $this->city()->people->map(function ($person) {
            return $person->name;
        });
        
        return array_diff($peopleFromTheSameLocality->toArray(), array($this->name));
    }
    
    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = [ 'name' ];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'interests';

    public function getNameAttribute($name)
    {
        return strtoupper($name); 
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower(trim($name));
    }

    public function people()
    {
        return $this->belongsToMany(Person::class);
    }
    
}

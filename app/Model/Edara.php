<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Edara extends Model
{
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
    	'gov_id', 'name'
    ];

    /**
     * Get the modria for the edara
     */
    public function gov()
    {
    	return $this->hasOne('App\Model\Gov', 'id', 'gov_id');
    }
}

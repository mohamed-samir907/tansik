<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
    	'edara_id', 'name'
    ];

    /**
     * Get the modria for the edara
     */
    public function edara()
    {
    	return $this->hasOne('App\Model\Edara', 'id', 'edara_id');
    }
}

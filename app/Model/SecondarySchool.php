<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SecondarySchool extends Model
{
    /**
     * The attributes that are mass assiagnable
     * 
     * @var array
     */
    protected $fillable = [
    	'section_id', 'type', 'name', 'gender', 'degree'
    ];

    /**
     * Get the section for the school
     */
    public function section()
    {
    	return $this->hasOne('App\Model\Section', 'id', 'section_id');
    }

}

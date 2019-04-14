<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
    	'school_id', 's_number', 's_code', 'national_id', 'phone', 'address', 'name','gender', 'arabic', 'english',
    	'dersat', 'al_gebra', 'handsa', 'total_math', 'science', 'total', 'notes',
    	'deen', 'art', 'computer'
    ];

    /**
     * Get the school for the students
     */
    public function school()
    {
        return $this->hasOne('App\Model\PrimarySchool', 'id', 'school_id');
    }

    public function ragabas()
    {
        return $this->hasOne('App\Model\Ragaba', 'student_id', 'id');
    }
}

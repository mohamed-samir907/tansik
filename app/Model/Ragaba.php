<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ragaba extends Model
{
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
    	'student_id', 'school', 'selected_ragaba'
    ];

    public function student()
    {
    	return $this->hasOne('App\Model\Student', 'id', 'student_id');
    }
    

    /**
     * Get the school data
     */
    public function school($id)
    {
    	return DB::table('schools')->select('*')->where('id', $id)->get();
    }
}

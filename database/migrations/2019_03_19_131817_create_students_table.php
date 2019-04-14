<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->integer('s_number')->unique();
            $table->integer('s_code')->unique();
            $table->string('national_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('name');
            $table->enum('system', ['home', 'school']);
            $table->enum('gender', ['male', 'female']);
            
            $table->string('arabic');
            $table->string('english');
            $table->string('dersat');
            $table->string('al_gebra');
            $table->string('handsa');
            $table->string('total_math');
            $table->string('science');
            $table->string('total');
            $table->string('deen');
            $table->string('art');
            $table->string('computer');
            $table->string('notes')->default('');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}

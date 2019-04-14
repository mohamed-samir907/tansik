<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondarySchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondary_schools', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('section_id');
            $table->string('name');
            $table->enum('gender', ['male', 'female', 'both']);
            $table->enum('type', ['high', 'hotel', 'industrial', 'trading', 'agricultural', 'other']);
            $table->double('degree', 5, 1);
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
        Schema::dropIfExists('secondary_schools');
    }
}

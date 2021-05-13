<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondaries', function (Blueprint $table) {
            $table->id();
            $table->string('schoolCode')->unique();
            $table->string('secondaryName');
            $table->string('level');
            $table->string('county');
            $table->string('subCounty');
            $table->string('role');
            $table->integer('capacity');
            $table->integer('minMark');
            $table->string('boxNumber')->unique();
            $table->string('email');
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
        Schema::dropIfExists('secondaries');
    }
}

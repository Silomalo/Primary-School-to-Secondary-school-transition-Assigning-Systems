<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeletionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seletions', function (Blueprint $table) {
            $table->id();
            $table->string('indexStaffNo')->unique();
            //$table->foreign('indexStaffNo')->references('indexStaffNo')->on('users')->onDelete('cascade');
            $table->string('national1');
            $table->string('national2');
            $table->string('national3');
            $table->string('national4');
            $table->string('exCounty1');
            $table->string('exCounty2');
            $table->string('county1');
            $table->string('county2');
            $table->string('district1');
            $table->string('district2');
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
        Schema::dropIfExists('seletions');
    }
}

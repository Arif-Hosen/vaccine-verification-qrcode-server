<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdftable', function (Blueprint $table) {
            $table->id();
            $table->string('certificateno');
            $table->string('nidnumber');
            $table->string('passportno');
            $table->string('nationality');
            $table->string('name');
            $table->string('dateofbirth');
            $table->string('gender');
            $table->string('datedose1');
            $table->string('namedose1');
            $table->string('dateofdose2');
            $table->string('namedose2');
            $table->string('vaccincenter');
            $table->string('vaccinatedby');
            $table->string('totaldose');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('pdftable');
    }
};

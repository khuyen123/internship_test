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
        Schema::create('Team_tb', function (Blueprint $table) {
            $table->string('team_id',20);
            $table->string('team_name',50)->nullable();
            $table->string('department_id',20);
            $table->timestamps();
            $table->foreign('department_id')->references('department_id')->on('Department_tb')->onUpdate('restrict')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Team_tb');
    }
};

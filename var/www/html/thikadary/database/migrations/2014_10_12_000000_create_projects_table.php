<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 250);
            $table->text('discription');
            $table->text('images');
            $table->string('skills', 400);
            $table->integer('fixed_budget');
            $table->integer('hourly_budget');
            $table->integer('competing_budget');
            $table->string('package_type', 20);
            $table->string('category', 20);
            $table->integer('hourly_budget');
            $table->integer('hire_user');
            $table->float('hire_value');
            $table->integer('win_bid_id');


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
        Schema::drop('projects');
    }
}
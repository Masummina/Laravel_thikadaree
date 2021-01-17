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
            $table->foreignId('user_id');
            $table->string('title', 250);
            $table->string('category', 100)->nullable();
            $table->text('discription');
            $table->text('images');
            $table->string('wantA', 50)->nullable();
            $table->integer('min_budget')->nullable();
            $table->integer('max_budget')->nullable();
            $table->integer('fixed_budget')->nullable();
            $table->string('paycondition', 50);
            $table->string('district', 100);
            $table->string('joblocatio', 250);
            $table->string('product_name', 250)nullable();
            $table->string('brandname', 100)nullable();
            $table->integer('modelYear')->nullable();
            $table->integer('pro_quantity')->nullable();
            $table->string('supp_country', 100)->nullable();
            $table->integer('project_fee')->default('0');
            $table->text('skills')->nullable();
            $table->integer('parday_pay')->nullable();
            $table->integer('num_labor')->nullable();
            $table->integer('lab_days')->nullable();
            $table->integer('contractor_type')->default('0');
            $table->integer('hire_user')->nullable();
            $table->float('hire_value')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->integer('win_bid_id')->default('0');
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
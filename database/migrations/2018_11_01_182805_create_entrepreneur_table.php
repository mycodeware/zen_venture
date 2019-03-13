<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrepreneurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepreneurs', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('family_name');
            $table->string('country_code', 2);
            $table->string('company_name');
            $table->string('company_website')->nullable();
            $table->string('company_address')->nullable();
            $table->date('founded_date')->nullable();
            $table->tinyInteger('number_of_members')->nullable();
            $table->string('company_vision', 300)->nullable();
            $table->string('board_members', 500)->nullable();
            $table->string('image_filename')->nullable();
            $table->string('briefing', 500)->nullable();
            $table->string('target_customers', 500)->nullable();
            $table->string('value_proposition', 300)->nullable();
            $table->string('competitors', 300)->nullable();
            $table->string('revenue_cost', 100)->nullable();
            $table->boolean('is_fundraising')->nullable();
            $table->tinyInteger('investment_round');
            $table->boolean('has_investor')->nullable();
            $table->string('investors', 100)->nullable();
            $table->tinyInteger('funding_amount')->nullable();
            $table->string('desired_help', 300)->nullable();
            $table->string('messages', 300)->nullable();
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
        Schema::dropIfExists('entrepreneurs');
    }
}

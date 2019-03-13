<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreelancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancers', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('family_name');
            $table->string('country_code', 2);
            $table->string('address')->nullable();
            $table->tinyInteger('age')->nullable();
            $table->string('website')->nullable();
            $table->string('image_filename')->nullable();
            $table->string('career', 500)->nullable();
            $table->tinyInteger('profession');
            $table->string('qualification', 100);
            $table->string('strength', 300)->nullable();
            $table->string('purpose_message', 300)->nullable();
            $table->string('appeal_message', 300)->nullable();
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
        Schema::dropIfExists('freelancers');
    }
}

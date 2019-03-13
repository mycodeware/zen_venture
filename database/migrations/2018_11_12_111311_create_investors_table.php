<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('family_name');
            $table->string('country_code', 2);
            $table->string('address')->nullable();
            $table->string('company_name');
            $table->string('website')->nullable();
            $table->string('image_filename')->nullable();
            $table->string('investment_policy', 300)->nullable();
            $table->string('business_area', 100)->nullable();
            $table->tinyInteger('round_start')->nullable();
            $table->tinyInteger('round_end')->nullable();
            $table->tinyInteger('scale_start')->nullable();
            $table->tinyInteger('scale_end')->nullable();
            $table->string('track_record', 300)->nullable();
            $table->boolean('has_invested')->nullable();
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
        Schema::dropIfExists('investors');
    }
}

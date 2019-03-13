<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('family_name');
            $table->string('position')->nullable();
            $table->string('department')->nullable();
            $table->string('company_name');
            $table->string('website')->nullable();
            $table->string('country_code', 2);
            $table->string('address')->nullable();
            $table->date('founded_date')->nullable();
            $table->tinyInteger('revenue_scale')->nullable();
            $table->tinyInteger('capital_scale')->nullable();
            $table->tinyInteger('employee_number')->nullable();
            $table->string('image_filename')->nullable();
            $table->string('briefing_business', 100)->nullable();
            $table->string('briefing_service', 300)->nullable();
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
        Schema::dropIfExists('companies');
    }
}

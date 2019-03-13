<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPvTotalToEntrepreneursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrepreneurs', function (Blueprint $table) {
            $table->unsignedBigInteger('pv_total')->after('starred')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrepreneurs', function (Blueprint $table) {
            $table->dropColumn('pv_total');
        });
    }
}

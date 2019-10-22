<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dev');
            $table->float('kwh1_ar');
            $table->float('kwh1_as');
            $table->float('kwh1_at');
            $table->float('kwh1_vr');
            $table->float('kwh1_vs');
            $table->float('kwh1_vt');
            $table->float('kwh2_ar');
            $table->float('kwh2_as');
            $table->float('kwh2_at');
            $table->float('kwh2_vr');
            $table->float('kwh2_vs');
            $table->float('kwh2_vt');
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
        Schema::dropIfExists('histories');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityPreSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_pre_schools', function (Blueprint $table) {
            $table->integer('anganwadi_centre_id');
            $table->integer('activity_id');
            $table->date('preschool_date');
            $table->timestamps();
        });

        Schema::table('activity_pre_schools', function (Blueprint $table) {
            $table->primary(['anganwadi_centre_id','activity_id','preschool_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_pre_schools');
    }
}

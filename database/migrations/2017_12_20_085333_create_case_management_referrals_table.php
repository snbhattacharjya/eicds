<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseManagementReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_management_referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('family_id');
            $table->integer('member_id');
            $table->smallInteger('target_type_id');
            $table->tinyInteger('age');
            $table->integer('anganwadi_centre_id');
            $table->enum('anganwadi_resident',['Y','N']);
            $table->date('first_symptom_date');
            $table->string('problem_desc');
            $table->integer('referred_centre_type_id');
            $table->string('referred_centre_name');
            $table->date('referred_date');
            $table->string('reached_facility',1);
            $table->string('next_reporting_status');
            $table->date('next_reporting_date');
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
        Schema::dropIfExists('case_management_referrals');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->string('aadhaar',12);
            $table->string('member_name');
            $table->string('relation',50);
            $table->string('gender',1);
            $table->string('marital_status',10);
            $table->date('dob');
            $table->smallInteger('target_id');
            $table->smallInteger('disability_id');
            $table->integer('anganwadi_centre_id');
            $table->string('anganwadi_resident',1);
            $table->boolean('active_status');
            $table->date('date_of_death');
            $table->string('cause_of_death');
            $table->smallInteger('category_id');
            $table->string('minority',1);
            $table->string('mobile',10);
            $table->string('bank_ifsc',50);
            $table->string('bank_name',50);
            $table->string('bank_account_no',50);

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
        Schema::dropIfExists('family_details');
    }
}

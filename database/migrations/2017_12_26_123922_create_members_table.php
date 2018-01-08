<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('family_id');
          $table->string('name');
          $table->string('aadhaar',12)->nullable();
          $table->string('relation',50);
          $table->enum('gender',['M','F']);
          $table->enum('marital_status',['Married','Unmarried']);
          $table->date('dob');
          $table->smallInteger('target_id');
          $table->smallInteger('disability_id');
          $table->integer('anganwadi_centre_id');
          $table->enum('anganwadi_resident',['Y','N']);
          $table->boolean('active_status')->default(1);
          $table->date('date_of_death')->nullable();
          $table->string('cause_of_death')->nullable();
          $table->string('mobile',10)->nullable();
          $table->string('bank_ifsc',50)->nullable();
          $table->string('bank_name',50)->nullable();
          $table->string('bank_account_no',50)->nullable();
          $table->string('image_path')->nullable();
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
        Schema::dropIfExists('members');
    }
}

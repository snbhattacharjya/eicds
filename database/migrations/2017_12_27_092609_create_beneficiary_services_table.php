<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_services', function (Blueprint $table) {
            $table->integer('family_id');
            $table->integer('member_id');
            $table->integer('service_id');
            $table->timestamps();
        });
        Schema::table('beneficiary_services', function (Blueprint $table) {
            $table->primary(['family_id','member_id','service_id'],'beneficiary_service_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiary_services');
    }
}

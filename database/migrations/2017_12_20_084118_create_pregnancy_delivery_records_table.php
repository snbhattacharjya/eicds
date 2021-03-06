<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePregnancyDeliveryRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnancy_delivery_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('family_id');
            $table->integer('member_id');
            $table->smallInteger('target_type_id');
            $table->tinyInteger('age');
            $table->integer('anganwadi_centre_id');
            $table->enum('anganwadi_resident',['Y','N']);
            $table->date('anganwadi_registration_date');
            $table->tinyInteger('pregnancy_order');
            $table->date('lmp_date');
            $table->date('edd_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('anganwadi_reported_date')->nullable();

            $table->timestamps();
        });

        Schema::table('pregnancy_delivery_records', function (Blueprint $table) {
            $table->unique(['member_id','pregnancy_order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregnancy_delivery_records');
    }
}

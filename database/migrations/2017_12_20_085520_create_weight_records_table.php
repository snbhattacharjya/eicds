<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeightRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('family_id');
            $table->integer('member_id');
            $table->smallInteger('target_type_id');
            $table->float('age');
            $table->integer('anganwadi_centre_id');
            $table->enum('anganwadi_resident',['Y','N']);
            $table->float('weight',4,2);
            $table->decimal('weight_change',4,2);
            $table->enum('weight_status',['Normal','Moderately Underweight','Severely Underweight']);
            $table->date('reported_date');
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
        Schema::dropIfExists('weight_records');
    }
}

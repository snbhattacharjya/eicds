<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplementaryFoodDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplementary_food_distributions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('family_id');
            $table->integer('member_id');
            $table->smallInteger('target_type_id');
            $table->float('age');
            $table->integer('anganwadi_centre_id');
            $table->enum('anganwadi_resident',['Y','N']);
            $table->date('ration_given_date');
            $table->enum('ration_given_quantity',['N','L']);

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
        Schema::dropIfExists('supplementary_food_distributions');
    }
}

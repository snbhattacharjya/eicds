<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplementaryDistributionFoodTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplementary_distribution_food_types', function (Blueprint $table) {
            $table->integer('distribution_id');
            $table->integer('food_type_id');
            $table->timestamps();
        });

        Schema::table('supplementary_distribution_food_types', function (Blueprint $table) {
            $table->primary(['distribution_id','food_type_id'],'distribution_food_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplementary_distribution_food_types');
    }
}

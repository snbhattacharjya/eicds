<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthProblemsReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_problems_referrals', function (Blueprint $table) {
            $table->integer('referral_id');
            $table->integer('problem_id');
            $table->timestamps();
        });

        Schema::table('health_problems_referrals', function (Blueprint $table) {
            $table->primary(['referral_id','problem_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_problems_referrals');
    }
}

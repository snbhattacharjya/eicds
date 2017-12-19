<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyMigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_migrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('family_id');
            $table->smallInteger('member_id');
            $table->string('anganwadi_centre_id');
            $table->timestamp('migrated_in_at');
            $table->timestamp('migrated_out_at');
            $table->string('migration_cause');
            $table->boolean('active_status');
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
        Schema::dropIfExists('family_migrations');
    }
}

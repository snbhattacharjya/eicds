<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MedicalProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('medical_procedures')->insert([
        'procedure_name' => 'Tetanus (TT)',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      DB::table('medical_procedures')->insert([
        'procedure_name' => 'Iron and Folic Acid (IFA)',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
}

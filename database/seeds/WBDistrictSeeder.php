<?php

use Illuminate\Database\Seeder;

class WBDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wb_districts = [
        	{'dist_code' => '337', 'dist_name' => '24 PARAGANAS NORTH' },
        	{'dist_code' => '343', 'dist_name' => '24 PARAGANAS SOUTH' },
        	{'dist_code' => '645', 'dist_name' => 'Alipurduar' },
        	{'dist_code' => '339', 'dist_name' => 'BANKURA' },
        	{'dist_code' => '334', 'dist_name' => 'BIRBHUM' },
        	{'dist_code' => '329', 'dist_name' => 'COOCHBEHAR' },
        	{'dist_code' => '327', 'dist_name' => 'DARJEELING' },
        	{'dist_code' => '331', 'dist_name' => 'DINAJPUR DAKSHIN' },
        	{'dist_code' => '330', 'dist_name' => 'DINAJPUR UTTAR' },
        	{'dist_code' => '338', 'dist_name' => 'HOOGHLY' },
        	{'dist_code' => '341', 'dist_name' => 'HOWRAH' },
        	{'dist_code' => '328', 'dist_name' => 'JALPAIGURI' },
        	{'dist_code' => '647', 'dist_name' => 'Jhargram' },
        	{'dist_code' => '646', 'dist_name' => 'KALIMPONG' },
        	{'dist_code' => '342', 'dist_name' => 'KOLKATA' },
        	{'dist_code' => '332', 'dist_name' => 'MALDAH' },
        	{'dist_code' => '345', 'dist_name' => 'MEDINIPUR EAST' },
        	{'dist_code' => '344', 'dist_name' => 'MEDINIPUR WEST' },
        	{'dist_code' => '333', 'dist_name' => 'MURSHIDABAD' },
        	{'dist_code' => '336', 'dist_name' => 'NADIA' },
        	{'dist_code' => '648', 'dist_name' => 'PASCHIM BARDHAMAN' },
        	{'dist_code' => '335', 'dist_name' => 'PURBA BARDHAMAN' },
        	{'dist_code' => '340', 'dist_name' => 'PURULIA' },
        ];
        foreach ($wb_districts as $wb_district) {
          DB::table('states')->insert([
            'state_id' => 36,
            'district_code' => $wb_district['dist_code'],
            'district_name' => $wb_district['dist_name'],
            'created_at' => now(),
            'updated_at' => now(),
          ]);
        }

    }
}

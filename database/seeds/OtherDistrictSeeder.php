<?php

use Illuminate\Database\Seeder;

class OtherDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $districts = [
      	["state_id" => 11, "district_code" => "474", "district_name" => "AHMADABAD"],
      	["state_id" => 11, "district_code" => "480", "district_name" => "AMRELI"],
      	["state_id" => 11, "district_code" => "482", "district_name" => "ANAND"],
      	["state_id" => 11, "district_code" => "685", "district_name" => "ARVALLI"],
      	["state_id" => 11, "district_code" => "469", "district_name" => "BANAS KANTHA"],
      	["state_id" => 11, "district_code" => "488", "district_name" => "BHARUCH"],
      	["state_id" => 11, "district_code" => "481", "district_name" => "BHAVNAGAR"],
      	["state_id" => 11, "district_code" => "680", "district_name" => "BOTAD"],
      	["state_id" => 11, "district_code" => "686", "district_name" => "CHHOTAUDEPUR"],
      	["state_id" => 11, "district_code" => "489", "district_name" => "DANG"],
      	["state_id" => 11, "district_code" => "681", "district_name" => "DEVBHUMI DWARKA"],
      	["state_id" => 11, "district_code" => "485", "district_name" => "DOHAD"],
      	["state_id" => 11, "district_code" => "473", "district_name" => "GANDHINAGAR"],
      	["state_id" => 11, "district_code" => "682", "district_name" => "GIR SOMNATH"],
      	["state_id" => 11, "district_code" => "477", "district_name" => "JAMNAGAR"],
      	["state_id" => 11, "district_code" => "479", "district_name" => "JUNAGADH"],
      	["state_id" => 11, "district_code" => "468", "district_name" => "KACHCHH"],
      	["state_id" => 11, "district_code" => "483", "district_name" => "KHEDA"],
      	["state_id" => 11, "district_code" => "471", "district_name" => "MAHESANA"],
      	["state_id" => 11, "district_code" => "683", "district_name" => "Mahisagar"],
      	["state_id" => 11, "district_code" => "684", "district_name" => "MORBI"],
      	["state_id" => 11, "district_code" => "487", "district_name" => "NARMADA"],
      	["state_id" => 11, "district_code" => "490", "district_name" => "NAVSARI"],
      	["state_id" => 11, "district_code" => "484", "district_name" => "PANCH MAHALS"],
      	["state_id" => 11, "district_code" => "470", "district_name" => "PATAN"],
      	["state_id" => 11, "district_code" => "478", "district_name" => "PORBANDAR"],
      	["state_id" => 11, "district_code" => "476", "district_name" => "RAJKOT"],
      	["state_id" => 11, "district_code" => "472", "district_name" => "SABAR KANTHA"],
      	["state_id" => 11, "district_code" => "492", "district_name" => "SURAT"],
      	["state_id" => 11, "district_code" => "475", "district_name" => "SURENDRANAGAR"],
      	["state_id" => 11, "district_code" => "493", "district_name" => "TAPI"],
      	["state_id" => 11, "district_code" => "486", "district_name" => "VADODARA"],
      	["state_id" => 11, "district_code" => "491", "district_name" => "VALSAD"],
        ["state_id" => 14, "district_code" => "014", "district_name" => "ANANTNAG"],
      	["state_id" => 14, "district_code" => "002", "district_name" => "BADGAM"],
      	["state_id" => 14, "district_code" => "009", "district_name" => "BANDIPORA"],
      	["state_id" => 14, "district_code" => "008", "district_name" => "BARAMULLA"],
      	["state_id" => 14, "district_code" => "016", "district_name" => "DODA"],
      	["state_id" => 14, "district_code" => "011", "district_name" => "GANDERBAL"],
      	["state_id" => 14, "district_code" => "021", "district_name" => "JAMMU"],
      	["state_id" => 14, "district_code" => "004", "district_name" => "KARGIL"],
      	["state_id" => 14, "district_code" => "007", "district_name" => "KATHUA"],
      	["state_id" => 14, "district_code" => "018", "district_name" => "KISHTWAR"],
      	["state_id" => 14, "district_code" => "015", "district_name" => "KULGAM"],
      	["state_id" => 14, "district_code" => "001", "district_name" => "KUPWARA"],
      	["state_id" => 14, "district_code" => "003", "district_name" => "LEH LADAKH"],
      	["state_id" => 14, "district_code" => "005", "district_name" => "POONCH"],
      	["state_id" => 14, "district_code" => "012", "district_name" => "PULWAMA"],
      	["state_id" => 14, "district_code" => "006", "district_name" => "RAJAURI"],
      	["state_id" => 14, "district_code" => "017", "district_name" => "RAMBAN"],
      	["state_id" => 14, "district_code" => "020", "district_name" => "REASI"],
      	["state_id" => 14, "district_code" => "022", "district_name" => "SAMBA"],
      	["state_id" => 14, "district_code" => "013", "district_name" => "SHOPIAN"],
      	["state_id" => 14, "district_code" => "010", "district_name" => "SRINAGAR"],
      	["state_id" => 14, "district_code" => "019", "district_name" => "UDHAMPUR"],
        ["state_id" => 3, "district_code" => "260", "district_name" => "ANJAW"],
      	["state_id" => 3, "district_code" => "253", "district_name" => "CHANGLANG"],
      	["state_id" => 3, "district_code" => "257", "district_name" => "DIBANG VALLEY"],
      	["state_id" => 3, "district_code" => "247", "district_name" => "EAST KAMENG"],
      	["state_id" => 3, "district_code" => "251", "district_name" => "EAST SIANG"],
      	["state_id" => 3, "district_code" => "677", "district_name" => "Kra Daadi"],
      	["state_id" => 3, "district_code" => "256", "district_name" => "KURUNG KUMEY"],
      	["state_id" => 3, "district_code" => "259", "district_name" => "LOHIT"],
      	["state_id" => 3, "district_code" => "675", "district_name" => "LONGDING"],
      	["state_id" => 3, "district_code" => "258", "district_name" => "LOWER DIBANG VALLEY"],
      	["state_id" => 3, "district_code" => "255", "district_name" => "LOWER SUBANSIRI"],
      	["state_id" => 3, "district_code" => "676", "district_name" => "NAMSAI"],
      	["state_id" => 3, "district_code" => "248", "district_name" => "PAPUM PARE"],
      	["state_id" => 3, "district_code" => "678", "district_name" => "SIANG"],
      	["state_id" => 3, "district_code" => "245", "district_name" => "TAWANG"],
      	["state_id" => 3, "district_code" => "254", "district_name" => "TIRAP"],
      	["state_id" => 3, "district_code" => "252", "district_name" => "UPPER SIANG"],
      	["state_id" => 3, "district_code" => "249", "district_name" => "UPPER SUBANSIRI"],
      	["state_id" => 3, "district_code" => "246", "district_name" => "WEST KAMENG"],
      	["state_id" => 3, "district_code" => "250", "district_name" => "WEST SIANG"],
        ["state_id" => 31, "district_code" => "616", "district_name" => "Ariyalur"],
      	["state_id" => 31, "district_code" => "603", "district_name" => "CHENNAI"],
      	["state_id" => 31, "district_code" => "632", "district_name" => "COIMBATORE"],
      	["state_id" => 31, "district_code" => "617", "district_name" => "CUDDALORE"],
      	["state_id" => 31, "district_code" => "630", "district_name" => "DHARMAPURI"],
      	["state_id" => 31, "district_code" => "612", "district_name" => "DINDIGUL"],
      	["state_id" => 31, "district_code" => "610", "district_name" => "ERODE"],
      	["state_id" => 31, "district_code" => "604", "district_name" => "KANCHIPURAM"],
      	["state_id" => 31, "district_code" => "629", "district_name" => "KANNIYAKUMARI"],
      	["state_id" => 31, "district_code" => "613", "district_name" => "KARUR"],
      	["state_id" => 31, "district_code" => "631", "district_name" => "KRISHNAGIRI"],
      	["state_id" => 31, "district_code" => "623", "district_name" => "MADURAI"],
      	["state_id" => 31, "district_code" => "618", "district_name" => "NAGAPATTINAM"],
      	["state_id" => 31, "district_code" => "609", "district_name" => "NAMAKKAL"],
      	["state_id" => 31, "district_code" => "615", "district_name" => "PERAMBALUR"],
      	["state_id" => 31, "district_code" => "621", "district_name" => "PUDUKKOTTAI"],
      	["state_id" => 31, "district_code" => "626", "district_name" => "RAMANATHAPURAM"],
      	["state_id" => 31, "district_code" => "608", "district_name" => "SALEM"],
      	["state_id" => 31, "district_code" => "622", "district_name" => "SIVAGANGA"],
      	["state_id" => 31, "district_code" => "620", "district_name" => "THANJAVUR"],
      	["state_id" => 31, "district_code" => "611", "district_name" => "THE NILGIRIS"],
      	["state_id" => 31, "district_code" => "624", "district_name" => "THENI"],
      	["state_id" => 31, "district_code" => "602", "district_name" => "THIRUVALLUR"],
      	["state_id" => 31, "district_code" => "619", "district_name" => "THIRUVARUR"],
      	["state_id" => 31, "district_code" => "614", "district_name" => "TIRUCHIRAPPALLI"],
      	["state_id" => 31, "district_code" => "628", "district_name" => "TIRUNELVELI"],
      	["state_id" => 31, "district_code" => "633", "district_name" => "TIRUPPUR"],
      	["state_id" => 31, "district_code" => "606", "district_name" => "TIRUVANNAMALAI"],
      	["state_id" => 31, "district_code" => "627", "district_name" => "TUTICORIN"],
      	["state_id" => 31, "district_code" => "605", "district_name" => "VELLORE"],
      	["state_id" => 31, "district_code" => "607", "district_name" => "VILLUPURAM"],
      	["state_id" => 31, "district_code" => "625", "district_name" => "VIRUDHUNAGAR"],
        ["state_id" => 25, "district_code" => "095", "district_name" => "CENTRAL"],
      	["state_id" => 25, "district_code" => "093", "district_name" => "EAST"],
      	["state_id" => 25, "district_code" => "094", "district_name" => "NEW DELHI"],
      	["state_id" => 25, "district_code" => "091", "district_name" => "NORTH"],
      	["state_id" => 25, "district_code" => "092", "district_name" => "NORTH EAST"],
      	["state_id" => 25, "district_code" => "090", "district_name" => "NORTH WEST"],
      	["state_id" => 25, "district_code" => "674", "district_name" => "SHAHDARA"],
      	["state_id" => 25, "district_code" => "098", "district_name" => "SOUTH"],
      	["state_id" => 25, "district_code" => "673", "district_name" => "South East"],
      	["state_id" => 25, "district_code" => "097", "district_name" => "SOUTH WEST"],
      	["state_id" => 25, "district_code" => "096", "district_name" => "WEST"],

      ];

      foreach ($districts as $district) {
        DB::table('districts')->insert([
          'state_id' => $district['state_id'],
          'district_code' => $district['district_code'],
          'district_name' => $district['district_name'],
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }
    }
}
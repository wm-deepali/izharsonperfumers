<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
class PincodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];
        LazyCollection::make(function () {
      $handle = fopen(public_path("Pincode.csv"), 'r');
      
      while (($row = fgetcsv($handle, 4096)) !== false) {
        // $dataString = implode(", ", $line);
        // $row = explode(';', $dataString);
        yield $row;
      }

      fclose($handle);
    })
    ->skip(1)
    ->chunk(1000)
    ->each(function (LazyCollection $chunk) {
             $records = $chunk->map(function ($row) {
          if(!empty($row)){
              $cities = City::where('name',$row[7])->first();
              if($cities){
                  DB::table('pincodes')->insert([
        'state_id'=>$cities->state_id,
        'city_id'=>$cities->id,
        'pincode'=>$row[4],
        ]);
                  return [
        'state_id'=>$cities->state_id,
        'city_id'=>$cities->id,
        'pincode'=>$row[4],
        ]; 
              }
       
          }
          
      })->toArray();
     
    //   print_r($records);
    //   DB::table('pincodes')->insert($records);
    });
    }
}

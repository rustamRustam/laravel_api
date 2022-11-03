<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddEquipment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $id = DB::table('equipment_type')->insertGetId(['name'=>'TP-Link TL-WR74','mask'=>'XXAAAAAXAA']);
      DB::table('equipment')->insert([
        ['id_type'=>$id,'serial_number'=>'91qaswe0zx','desc'=>'Good'],
        ['id_type'=>$id,'serial_number'=>'91qaswe3zx','desc'=>'Normal'],
        ['id_type'=>$id,'serial_number'=>'91qaswe5zx','desc'=>'']
      ]);

      $id = DB::table('equipment_type')->insertGetId(['name'=>'D-Link DIR-300','mask'=>'NXXAAXZXaa']);
      DB::table('equipment')->insert([
        ['id_type'=>$id,'serial_number'=>'7AASA0_0zx','desc'=>'Good'],
        ['id_type'=>$id,'serial_number'=>'7BBSA0_3zx','desc'=>'Normal'],
        ['id_type'=>$id,'serial_number'=>'7CCSA0_5zx','desc'=>'']
      ]);


      DB::table('equipment_type')->insert([
          ['name'=>'TP-Link Archer AX6000','mask'=>'XNXaaXZXAA'],
          ['name'=>'D-Link DIR-300 E','mask'=>'NAAAAXZXXX'],
          ['name'=>'HUAWEI B311-221','mask'=>'XNAAAXXXaa'],
          ['name'=>'HUAWEI WS7100','mask'=>'XNAAXXXAaa'],
          ['name'=>'ZTE 920U PRO SMART','mask'=>'NNaaaaaaaa'],
      ]);

    }
}

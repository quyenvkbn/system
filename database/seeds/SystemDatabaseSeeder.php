<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Quyenvkbn\System\Models\System;

class SystemDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $system = get_value_system(array(), config('system'), session('locale'));
        if (!empty($system)) {
            $data_system = array();
            foreach ($system as $key => $value) {
                if ($value) {
                    foreach ($value as $k => $val) {
                        $data_system[] = [
                            'keyword' => $k
                        ];
                    }
                }
            }
            if (!empty($data_system)) {
                System::insert($data_system);
            }
            
        }
    }
}

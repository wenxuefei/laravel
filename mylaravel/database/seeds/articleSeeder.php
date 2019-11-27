<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class articleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [];

        for ($i = 0; $i < 30; $i++){
            $temp = [];
            $temp['title'] = $this->str_random(20);
            $temp['content'] = $this->str_random(180);
            $data[$i]  = $temp;
        }
        DB::table('articles')->insert($data);
    }
    public function str_random($length)
    {
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        $key = '';
        for ($i = 0; $i < $length; $i++) {
            $key .= $pattern{mt_rand(0, 35)}; //生成php随机数
        }
        return $key;
    }
}

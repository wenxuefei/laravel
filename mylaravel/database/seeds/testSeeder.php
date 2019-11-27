<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class testSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr = [];

        for ($i = 0; $i < 20; $i++) {
            $temp = [];
            $temp['username'] = $this->str_random(20);
            $temp['password'] = $this->str_random(20);
            $temp['nickname'] = $this->str_random(20);
            $temp['group_id'] = rand(1, 20);
            $temp['email'] = rand(10000, 99999999) . '@qq.com';
            $temp['sex'] = rand(0, 1);

            $arr[$i] = $temp;
        }

        DB::table('test')->insert($arr);

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

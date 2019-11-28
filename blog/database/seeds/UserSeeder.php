<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
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
        for ($i = 0; $i < 100; $i++) {
            $temp = [];
            $temp['username'] = $this->str_random(20);
            $temp['email'] = $this->str_random(8).'@qq.com';
            $temp['password'] = Hash::make('123456789');
            $temp['profile'] = '/uploads/20191128/1574923867218286.png';
            $temp['intro'] = $this->str_random(100);
            $temp['created_at'] = date('Y-m-d H:i:s');
            $temp['updated_at'] = date('Y-m-d H:i:s');
            $arr[] = $temp;
        }
        DB::table('users')->insert($arr);
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

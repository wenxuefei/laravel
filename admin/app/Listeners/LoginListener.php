<?php

namespace App\Listeners;

use App\Events\AdminLoginEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\AdminLog;
//implements ShouldQueue
class LoginListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param AdminLoginEvent $event
     * @return void
     */
    public function handle(AdminLoginEvent $event)
    {
        $data = [];
        //获取事件中保存的信息
        $admin = $event->getAdmin();
        $agent = $event->getAgent();
        $ip = $event->getIp();
        $timestamp = $event->getTimestamp();

        //登录信息
        $login_info = [
            'ip' => $ip,
            'login_time' => $timestamp,
            'admin_id' => $admin->id,
            'admin_name' => $admin->username,
        ];

        $address = \Ip::find($ip);

        $login_info['address'] = implode(' ', $address);

        $login_info['device'] = $agent->device();    //设备名称
        $browser = $agent->browser();
        $login_info['browser'] = $browser . ' ' . $agent->version($browser); //浏览器
        $platform = $agent->platform();
        $login_info['platform'] = $platform . ' ' . $agent->version($platform); //操作系统
        $login_info['language'] = implode(',', $agent->languages());    //语言
        //设备类型
        if ($agent->isTablet()) {
            // 平板
            $login_info['device_type'] = 'tablet';
        } else if ($agent->isMobile()) {
            // 便捷设备
            $login_info['device_type'] = 'mobile';
        } else if ($agent->isRobot()) {
            // 爬虫机器人
            $login_info['device_type'] = 'robot';
            $login_info['device'] = $agent->robot(); //机器人名称
        } else {
            // 桌面设备
            $login_info['device_type'] = 'desktop';
        }

        //插入到数据库
        AdminLog::insert($login_info);
        DB::table('admins')->where('id', $admin->id)->update(['last_ip' => $ip, 'last_login' => $timestamp]);
    }
}

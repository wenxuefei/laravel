<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminLoginEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Model Admin 后台用户模型
     */
    protected $admin;

    /**
     * @var object Agent 客户端信息
     */
    protected $agent;

    /**
     * @var string IP IP地址
     */
    protected $ip;

    /**
     * @var int 登录时间戳
     */
    protected $timestamp;


    /**
     * Create a new event instance.
     * 实例化事件时传递这些信息
     * @param $admin
     * @param $agent
     * @param $ip
     * @param $timestamp
     */
    public function __construct($admin, $agent, $ip, $timestamp)
    {
        $this->admin = $admin;
        $this->agent = $agent;
        $this->ip = $ip;
        $this->timestamp = $timestamp;
    }

    public function getAdmin(){
        return $this->admin;
    }

    public function getAgent(){
        return $this->agent;
    }

    public function getIp(){
        return $this->ip;
    }

    public function getTimestamp(){
        return $this->timestamp;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

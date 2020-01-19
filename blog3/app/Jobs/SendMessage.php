<?php

namespace App\Jobs;

use App\Models\Notice;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $notice;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Notice $notice)
    {
        $this->notice = $notice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();

//        $dispatch(new \App\Jobs\SendMessage($notice));
//        启动队列 php artisan queue:work
//        启动队列常驻 nohup php artisan queue:work >>/dev/null &
        foreach ($users as $user){
            $user->addNotice($this->notice);
        }
    }
}

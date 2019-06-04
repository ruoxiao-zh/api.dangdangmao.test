<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateUserToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qdd:generate-user-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '快速为生成用户 token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $adminUserId = $this->ask('请输入用户 id');

        $adminUser = User::find($adminUserId);

        if ( !$adminUser) {
            return $this->error('管理员不存在');
        }

        // 一年以后过期
        $ttl = 365 * 24 * 60;
        $this->info(\Auth::guard('users')->setTTL($ttl)->fromUser($adminUser));
    }
}

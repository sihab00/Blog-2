<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
use App\Notifications\RemindEmail;

class EmailInactiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactive-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Inactive User';

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
        $limit = Carbon::now()->subDay(7);

        $inactiveUsers = User::where('last_login','<','2019-03-06 15:54:28')->get();

        foreach ($inactiveUsers as $user) {
           
           $user->notify(new RemindEmail());
           $this->info('Email sent to'. $user->email);
        }
    }
}

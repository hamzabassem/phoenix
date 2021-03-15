<?php

namespace App\Console\Commands;

use App\Store;
use App\User;
use Illuminate\Console\Command;

class MinusDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:MinusDay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {

        $users = Store::where('days','>',0)->get();
        foreach ($users as $user){
            $user->update([
                'days' => $user->days - 1
            ]);
        }




    }
}

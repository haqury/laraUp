<?php

namespace App\Console\Commands;

use App\Blocks;
use App\LangsText;
use App\Service\Service;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $argument;

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
        $block = new Blocks();
        var_dump($schema = Service::form()->getFormConfig($block, $block->find(1)));
//        var_dump($schema = \DB::select(DB::raw(
//            "SELECT
//                information_schema.columns.*
//            FROM
//                information_schema.columns
//            WHERE
//                1=1
//                AND table_name = 'blocks'
//                AND table_schema = 'boxberry'"
//        )));
    }
}

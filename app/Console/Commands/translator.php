<?php

namespace App\Console\Commands;

use App\Service\TranslatorService;
use Illuminate\Console\Command;

class translator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translator:recache';

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
     * @return mixed
     */
    public function handle()
    {
//        $langs = new Langs();
//        $langs = $langs->where('active', 1);
//        if (!empty($langId)) {
//            $langs = $langs->where('shortName', $langShortNames);
//        }
//        $langs = $langs->all();
//        if (empty($langs)) {
//            return false;
//        }
//
//        Redis::hmset('laungauges:' . $langId, $langs);
        $translatorService = new TranslatorService();
        $translatorService->recache();
    }
}

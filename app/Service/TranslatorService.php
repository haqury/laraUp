<?php
namespace App\Service;


use App\Langs;
use App\LangsText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class TranslatorService
{
    protected $strings = [];
    protected $laungauges = '';

    public function __construct()
    {
        $url = URL::current();
        var_dump($url);
//        $subdomain = preg_match('', ,$url);
//        $domain = $this->app->route();
//        $laungauges = $domain;
    }

    public function translate($name, $lang = '') {
        if ($lang = '') {

        }
        $string = $this->getTranslate($name, $lang);
        return !empty($string) ? $string : $name;
    }

    public function recache($langShortNames = []) {
        $langs = new Langs();
        $langs->where('active', 1);
        if (!empty($langId)) {
            $langs->where('shortName', $langShortNames);
        }
        $langs = $langs->all();
        if (empty($langs)) {
            return false;
        }

        Redis::hmset('laungauges:' . $langId, $langs);
    }

    private function getTranslate($name, $langId)
    {
        if (!empty($this->strings) && !empty($this->strings[$name])) {
            return $this->strings[$name];
        }
        $this->strings = Redis::hmget('laungauges:' . $langId);
        if (!empty($this->strings)) {
            return $this->strings[$name];
        }
        $langsText = new LangsText();
        $langsText->where('langs_id', 1);
        $strings = $langsText->all()->toArray();
        $this->strings = array_combine(array_column($strings, 'name'), array_column($strings, 'text'));
        $this->strings = $langsText->keyBy('name')->get('text');
        if (!empty($this->strings)) {
            return $this->strings[$name];
        }
        return false;
    }
}
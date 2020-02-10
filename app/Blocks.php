<?php

namespace App;

use App\Service\Service;
use Illuminate\Database\Eloquent\Model;

class Blocks extends Model
{
    /**
     * получить обработанный хтмл для страницы
     * @param $page
     * @return string
     */
    public static function getHtml($page)
    {
        $blocks = self::getForPage($page);
        $html = '';
        if (empty($blocks)) {
            return $html;
        }
        foreach ($blocks as $block) {
            $html .= PHP_EOL . $block->view();
        }
        return $html;
    }

    /**
     * получить обработанный хтмл для блока
     * @param $page
     * @return string
     */
    public static function getHtmlBlock($id)
    {
        return self::find($id)->view();
    }

    /**
     * Получить блоки для страницы
     * @param $page
     * @return Blocks
     */
    public static function getForPage($page)
    {
        $blocks = new self();
        $blocks = $blocks->where('page', $page)->orderBy('weight', 'desc');
        return $blocks->get();
    }

    /**
     * Обработчик хтмл блока
     * @return string
     */
    public function view()
    {
        return Service::blade()->bladeCompile($this->blade);
    }
}

<?php

namespace App\Http\Controllers;

use App\Blocks;
use App\Service\Service;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @param $blockId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function block($blockId = 0)
    {
        $block = new Blocks();
        $configModel = Service::form()->getFormConfig($block, $block->find($blockId));
        return view('Admin.block',
            [
                'configModel' => Service::form()->getFormConfig($block, $block->find($blockId)),
                'result' => !empty($configModel['model']['blade'])
                    ? ['html' => $block->getHtmlBlock($blockId)]
                    : ['html' => ''],
            ]
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    public function saveBlock(Request $request)
    {
        $input = $request->post()['data'];
        if (!empty($input['id'])) {
            Blocks::where('id', '=', $input['id'])->update($input);
        } else {
            Blocks::create($input);
        }
        return ['html' => Blocks::getHtmlBlock($input['id'])];
    }
}

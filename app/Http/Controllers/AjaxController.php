<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DarthSoup\Whmcs\WhmcsManager;

class AjaxController extends Controller
{
    private WhmcsManager $whmcsManager;

    public function __construct(WhmcsManager $whmcsManager)
    {
        $this->whmcsManager = $whmcsManager;
    }
    public function getproductDetail(Request $request)
    {
        $detailProduct = $this->whmcsManager->orders()->getProducts([
            'pid' => (int)$request['id'],
        ]);
        $data = $detailProduct['products']['product'][0]['pricing']['IDR'];
        $array = array();
        foreach ($data as $x => $val) {
            if (preg_match("/ly/i", $x)) {
                $array[$x] = $val;
            }
        }
        return response()->json([
            'prefix' => $data['prefix'],
            'suffix' => $data['suffix'],
            'pricing' => $array
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DarthSoup\Whmcs\WhmcsManager;

class IndexController extends Controller
{
    private WhmcsManager $whmcsManager;

    public function __construct(WhmcsManager $whmcsManager)
    {
        $this->whmcsManager = $whmcsManager;
    }
    public function index()
    {
        $data = [
            'site_name' => env('APP_NAME'),
            'page_name' => 'Halaman Utama'
        ];
        return view('index', $data);
    }
    public function neworder()
    {
        $product = $this->whmcsManager->orders()->getProducts();
        $data = [
            'site_name' => env('APP_NAME'),
            'page_name' => 'Pemesan Layanan',
            'product' => $product['products']['product']
        ];
        return view('neworder', $data);
    }
}

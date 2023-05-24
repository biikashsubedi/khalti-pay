<?php

namespace App\Http\Controllers\System\ApiKey;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\ConfigRequest;

class ApiKeyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexUrl()
    {
        return 'apiKey';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['title'] = 'Api Key';
        $data['indexUrl'] = $this->indexUrl();
        $data['breadcrumbs'] = breadcrumbForIndex($data['title'], $this->indexUrl());

        return view('system.apiKey.index', $data);
    }
}

<?php

namespace App\Http\Controllers\System\TransactionLog;

use App\Http\Controllers\Controller;
use File;

class TransactionLogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexUrl()
    {
        return 'transactionLog';
    }

    public function index()
    {
        $data['title'] = 'Transaction Log';
        $data['indexUrl'] = $this->indexUrl();
        $data['breadcrumbs'] = breadcrumbForIndex($data['title'], $data['indexUrl']);

        return view('system.transactionLogs.index', $data);
    }
}

<?php

namespace App\Http\Controllers\System\TransactionLog;

use App\Http\Controllers\Controller;
use App\Models\TransactionLog;
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

    public function show($id)
    {
        $log = TransactionLog::findOrFail($id);
        $data['title'] = 'View Transaction Log';
        $data['indexUrl'] = $this->indexUrl();
        $data['breadcrumbs'] = breadcrumbForIndex($data['title'], $data['indexUrl']);
        $data['item'] = $log;
        return view('system.transactionLogs.show', $data);
    }
}

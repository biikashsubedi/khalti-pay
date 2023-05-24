<?php

namespace App\Http\Controllers\System\Payment;

use App\Domain\PaymentModeDomain;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\PaymentRequest;
use App\Models\Payment;
use File;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->domain = (new PaymentModeDomain());
        $this->middleware('auth');
    }

    public function indexUrl()
    {
        return 'payment';
    }

    public function index()
    {
        $data['title'] = 'Payment Method';
        $data['indexUrl'] = $this->indexUrl();
        $data['breadcrumbs'] = breadcrumbForIndex($data['title'], $data['indexUrl']);

        return view('system.payment.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Create Payment Method';
        $data['indexUrl'] = $this->indexUrl();
        $data['breadcrumbs'] = breadcrumbForIndex($data['title'], $data['indexUrl']);
        $data['status'] = $this->status();
        $data['mode'] = $this->mode();
        $data['defaults'] = $this->default();
        $data['titles'] = $this->getSupportedPaymentCodes();

        return view('system.payment.form', $data);
    }

    public function edit($id)
    {
        $data['item'] = Payment::findOrFail($id);
        $data['title'] = 'Edit Payment Method';
        $data['indexUrl'] = 'payment/' . $id . '/config';
        $data['breadcrumbs'] = breadcrumbForForm($data['title'], $data['indexUrl'], 'Payment', $this->indexUrl());
        $data['status'] = $this->status();
        $data['mode'] = $this->mode();
        $data['defaults'] = $this->default();
        $data['titles'] = $this->getSupportedPaymentCodes();

        return view('system.payment.form', $data);
    }

    public function getSupportedPaymentCodes()
    {
        $mapped = [];
        foreach (Payment::$supportedPaymentCodes as $code) {
            $mapped[ucwords($code)] = strtolower($code);
        }

        return $mapped;
    }

    public function default()
    {
        return [
            ['value' => 1, 'label' => 'True'],
            ['value' => 0, 'label' => 'False'],
        ];
    }

    public function mode()
    {
        return [
            ['value' => 1, 'label' => 'Live'],
            ['value' => 0, 'label' => 'Sandbox'],
        ];
    }

    public function status()
    {
        return [
            ['value' => 1, 'label' => 'Active'],
            ['value' => 0, 'label' => 'Inactive'],
        ];
    }


    public function store(PaymentRequest $request)
    {
        $requestData = $this->domain->store($request);
        Payment::create($requestData);
        return redirect()->to($this->indexUrl())->withErrors(['alert-success' => 'Payment Method Successfully Created.']);
    }

    public function destroy(Request $request, $id)
    {
        $data = Payment::findOrFail($id);
        $data->delete();
        return redirect($this->indexUrl())->withErrors(['alert-success' => 'Payment Method Successfully Deleted.']);
    }


    public function update(PaymentRequest $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $requestData = $this->domain->store($request);
        $payment->update($requestData);
        return redirect()->to($this->indexUrl())->withErrors(['alert-success' => 'Payment Method Successfully Updated.']);
    }

    public function showConfigForm($id)
    {
        $paymentMethod = Payment::findOrFail($id);
        $indexUrl = 'payment/' . $id . '/config';
        $title = 'Payment Method Configuration';

        try {
            $getDataFromConfig = \Config::get('paymentModeField')[$paymentMethod->code];
            if (!isset($getDataFromConfig) && empty($getDataFromConfig) && count($getDataFromConfig) < 1) {
                return redirect()->back()->withErrors(['alert-danger' => 'You can\'t configure this payment method.']);
            }

        } catch (\Exception $e) {
            \Log::error('unable to perform configure of payment method ' . $e);
            return redirect()->back()->withErrors(['alert-danger' => 'You can\'t configure this payment method.']);
        }

        $data = [
            'item' => $paymentMethod,
            'live' => $paymentMethod->live ?? [],
            'sandbox' => $paymentMethod->sandbox ?? [],
            'fields' => $getDataFromConfig,
            'indexUrl' => $indexUrl,
            'title' => $title,
            'breadcrumbs' => breadcrumbForForm($title, $indexUrl, 'Payment', $this->indexUrl())
        ];

        return view('system.payment.config', $data);
    }

    public function storeConfigForm(Request $request)
    {
        $data = $this->domain->config($request);
        $paymentMode = Payment::findOrFail($data['id']);
        $paymentMode->update([
            'live' => $data['live'],
            'sandbox' => $data['sandbox']
        ]);
        return redirect($this->indexUrl())->withErrors(['alert-success' => 'Payment Method Configuration Successfully Updated.']);
    }
}

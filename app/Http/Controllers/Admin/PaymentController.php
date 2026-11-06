<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePaymentRequest;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['subscription.member', 'sale.member'])->latest('payment_date')->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(StorePaymentRequest $request)
    {
        Payment::create($request->validated());

        return redirect()->route('admin.payments.index')->with('success', 'Payment recorded.');
    }
}
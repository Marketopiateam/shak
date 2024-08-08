<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    function index() 
    {
        $rows       = PaymentTransaction::orderBy('id', 'desc')->paginate(20);
        $pageTitle = __('app.payments');

        return view('admin.payments.index', compact('rows'));
    }
    function requests() 
    {
        $rows       = WithdrawRequest::orderBy('success', 'asc')->paginate(20);
        $pageTitle = __('app.withdraw_requests');

        return view('admin.payments.requests', compact('rows'));

    }
    
    function accept($id) 
    {
        
    }
    function reject($id) 
    {
        
    }
}

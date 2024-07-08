<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WalletTransaction;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WalletTransactionController extends BaseController
{
    public function __construct(WalletTransaction $model)
    {
        parent::__construct($model);
    }
    public function mostPaidClients()
    {
        // Fetch clients ordered by the total amount paid
        $clients = Client::withSum('payments', 'amount')
            ->orderBy('payments_sum_amount', 'desc')
            ->take(10) // You can adjust the number of clients to fetch
            ->get();

        return response()->json($clients);
    }
}

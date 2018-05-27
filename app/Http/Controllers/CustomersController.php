<?php

namespace App\Http\Controllers;

use App\Classes\Api\Customers as Customers;
use Illuminate\Routing\Controller as BaseController;

class CustomersController extends BaseController
{
    public function index($page = 1)
    {
        $customers = new Customers();

        return view('customers', [
            'customers' => $customers->getCustomers($page, env('PAGINATION_ITEMS_PER_PAGE')),
            'lifeTimeValue' => 100,
        ]);
    }
}

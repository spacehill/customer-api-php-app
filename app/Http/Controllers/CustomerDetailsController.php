<?php

namespace App\Http\Controllers;

use App\Classes\Api\Customers as Customers;
use Illuminate\Routing\Controller as BaseController;

class CustomerDetailsController extends BaseController
{

    public function show($id, $page = 1)
    {
        $customers = new Customers();

        return view('details', [
            'customer' => $customers->getCustomerById($id),
            'lifeTimeValue' => 100,
        ]);
    }

}

<?php

namespace App\Classes\Api;

use App\Classes\Api\Orders as Orders;
use Bigcommerce\Api\Client as Bigcommerce;

class Customers
{

    /**
     * get list of custsomers, paginated
     *
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getCustomers($page = 1, $limit = 30)
    {

        $customersCount = Bigcommerce::getCustomersCount();
        $totalPages = ceil($customersCount / $limit);

        // read customers based on pagination filters
        $filter = array("page" => $page, "limit" => $limit);
        $customers = Bigcommerce::getCustomers($filter);

        if (!$customers) {
            $error = Bigcommerce::getLastError();
            $customers = array();
            // TODO: log error and change $result to an error response to be handled by template
        }

        //enrich customers with amount of orders for the given result
        $orders = new Orders();
        foreach ($customers as $key => $customer) {
            $customer->number_of_orders = $orders->getOrdersCountByCustomerId($customer->id);
        }

        $result = array(
            "items" => $customers,
            "count" => count($customers),
            "total_items" => $customersCount,
            "page" => $page,
            "items_per_page" => $limit,
            "total_pages" => $totalPages,
        );

        return $result;
    }

    /**
     * get customer based on a customer id
     *
     * @param int $id
     * @return Resources\Customer
     */
    public function getCustomerById($id)
    {

        $customer = Bigcommerce::getCustomer($id);
        if (!$customer) {
            $error = Bigcommerce::getLastError();
            // TODO: log error
        } else {
            //enrich customer with orders and the life time value
            $orders = new Orders();
            $customer->orders = $orders->getOrdersByCustomerId($id);
            $customer->life_time_value = $this->getLifeTimeValue($customer->orders);
        }
        return $customer;
    }

    /**
     *
     * calculates the life time value of a customer
     *
     * @param array $customerOrders
     * @return float
     */
    private function getLifeTimeValue($customerOrders)
    {

        $lifeTimeValue = 0;

        foreach ($customerOrders as $key => $customerOrder) {
            $lifeTimeValue += $customerOrder->total_inc_tax;
        }
        return $lifeTimeValue;
    }

}

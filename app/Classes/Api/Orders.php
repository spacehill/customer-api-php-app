<?php

namespace App\Classes\Api;

use Bigcommerce\Api\Client as Bigcommerce;

class Orders
{

    /**
     * get orders based on customer id
     * 
     * @param id $customerId
     * @return array
     */
    public function getOrdersByCustomerId($customerId)
    {

        // read orders based on customer id
        $filter = array("customer_id" => $customerId);
        $orders = Bigcommerce::getOrders($filter);

        if (!$orders) {
            $error = Bigcommerce::getLastError();
            $orders = array();
        }

        return $orders;
    }

    /**
     *
     * @param int $customerId
     * @return int
     */
    public function getOrdersCountByCustomerId($customerId)
    {
        $filter = array("customer_id" => $customerId);

        $ordersCount = Bigcommerce::getOrdersCount($filter);

        if (!$ordersCount) {
            $error = Bigcommerce::getLastError();
            // TODO: log error
            $ordersCount = 0;

        }
        return $ordersCount;
    }
}

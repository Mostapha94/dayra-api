<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface OrderInterface
 * @package App\Repositories\Interfaces
 */
interface OrderInterface
{
    /**
     * Get All orders at table
     * @param $per_page
     * @return mixed
     */
    public function getAllOrders($per_page);
    /**
     * Add New Order
     * @param $per_page
     * @return mixed
     */
    public function addOrder($request);
    /**
     * Get Single Order By id
     * @param $orderId
     * @return Order
     */
    public function getOrderById($orderId);
    /**
     * Update Single Order By Id
     * @param $orderId
     * @param $request
     */
    public function updateOrderById($orderId,$request);
    /**
     * delete Order by id
     * @param $orderId
     */
    public function deleteOrderById($orderId);
  
}
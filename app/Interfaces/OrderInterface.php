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
    /**
    * add product to cart
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function addProductToCart($request);
    /**
    * update product in cart
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function updateProductInCart($request);
    /**
    * checkout process to all products in cart
    * @param  \Illuminate\Http\Request  $request
    */
    public function checkout($request);
  
}
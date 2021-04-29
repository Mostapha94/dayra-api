<?php
namespace App\Repositories;
use Request;
use App\Models\Order;
use App\Interfaces\OrderInterface;
/**
 * Class OrderRepository
 * @package App\Repositories
 */
class OrderRepository implements OrderInterface
{
    /**
     * @var $order
     */
    protected $order;
    /**
     * OrderRepository constructor.
     */
    public function __construct()
    {
        $this->order = new Order();
    }
    /**
     * get all orders
    * @return mixed
    */
    public function getAllOrders($per_page){
        return  $this->order->paginate($per_page);
    }
    /**
     * add new order
    * @param Model $order
    * @param $request
    * @return Order Item
    */
    public function addOrder($request){
        return $this->save($request,$this->order);
    }
    /**
    * get order by id
    * @param $orderId
    * @return Order Item
    */
    public function getOrderById($orderId){
        return $this->order->find($orderId);
    }
    /**
    * update order by id
    * @param $orderId
    * @param $request
    * @return Order Item
    */
    public function updateOrderById($orderId,$request){
        $order = $this->order->find($orderId);
        return $this->save($request,$order);
    }
    /**
     * delete order by id
     * @param $orderId
     */
    public function deleteOrderById($orderId){
        $order=$this->order->find($orderId);
        $order->deleted_at = now();
        $order->save();
    }
    /**
    * general function to save data model
    * @param $request
    * @param Model $order
    * @return Order Item
    */
    public function save($request,$order){
        $order->fill($request->all());
        $order->save();
        return $order;
    }
}

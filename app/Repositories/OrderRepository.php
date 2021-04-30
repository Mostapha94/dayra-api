<?php
namespace App\Repositories;
use Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
        return $this->order->with('product','user')->find($orderId);
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
    /**
    * add product to cart
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function addProductToCart($request){
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ));
    }
    /**
    * update product in cart
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function updateProductInCart($request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
    }
    /**
    * checkout process to all products in cart
    * @param  \Illuminate\Http\Request  $request
    */
    public function checkout($request){
        $user=User::find($request->user_id);
        foreach(json_decode($request->products) as $product){
            $order=new Order();
            $order->product_id=$product->id;
            $order->user_id=$user->id;
            $order->quantity=$product->quantity;
            $order->save();

            //async with product units
            $product_unit=Product::find($product->id);
            $product_unit->units--;
            $product_unit->save();
        }
        //edit walit
        $user->withdraw($request->total_price); 
    }

}

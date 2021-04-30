<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Traits\GeneralTrait;

use Illuminate\Http\Request;

class CartController extends Controller
{
    use GeneralTrait;
    /**
    * @var $orderRepository
    */
    protected $orderRepository;
    /**
     * ProductController constructor.
    */
    public function __construct()
    {
        $this->orderRepository=new OrderRepository();
    }
    /**
     * Display a listing of all products in shop
     *
     * @return \Illuminate\Http\Response
     */
    public function shop()
    {
        return view('frontend.index')->withTitle('Dayra STORE | SHOP')->with(['products' => $this->getAllProducts()]);
    }
    /**
     * Display a listing of all products in cart
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()  {
        $cartCollection = \Cart::getContent();
        return view('frontend.cart')->withTitle('Dayra STORE | CART')->with(['cartCollection' => $cartCollection]);;
    }
    /**
    * add product to cart
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function add(Request $request){
        $this->orderRepository->addProductToCart($request);
        return redirect()->route('cart.index')->with('success_msg', 'Item is Added to Cart!');
    }
    /**
    * remove selected product in cart
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }
    /**
    * update selected product in cart
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request){
        $this->orderRepository->updateProductInCart($request);
        return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
    }
    /**
    * checkout to all products in cart
    */
    public function clear(){
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Cart is cleared!');
    }
    /**
    * checkout to all products in cart
    */
    public function checkout(Request $request){
        $request['products']=\Cart::getContent();
        $request['user_id']=auth()->user()->id;
        $request['total_price']=\Cart::getTotal();
        $this->orderRepository->checkout($request);
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Checkoute Done Successfully!');
    }

}
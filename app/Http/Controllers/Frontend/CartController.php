<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function shop()
    {
        $products = Product::where('units','>',0)->paginate(20);
        return view('frontend.index')->withTitle('Dayra STORE | SHOP')->with(['products' => $products]);
    }

    public function cart()  {
        $cartCollection = \Cart::getContent();
        return view('frontend.cart')->withTitle('Dayra STORE | CART')->with(['cartCollection' => $cartCollection]);;
    }

    public function add(Request $request){
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Item is Added to Cart!');
    }

    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function update(Request $request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
    }
    public function clear(){
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Cart is cleared!');
    }
    public function checkout(){
        foreach(\Cart::getContent()as $product){
            $order=new Order();
            $order->product_id=$product->id;
            $order->user_id=auth()->user()->id;
            $order->quantity=$product->quantity;
            $order->save();

            //async with product units
            $product_unit=Product::find($product->id);
            $product_unit->units--;
            $product_unit->save();
        }

        auth()->user()->withdraw(\Cart::getTotal()); 
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Checkoute Done Successfully!');
    }

}
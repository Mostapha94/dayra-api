<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersResource;
use App\Traits\GeneralTrait;
use App\Repositories\OrderRepository;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use GeneralTrait;
    /**
    * @var $OrderRepository
    */
    protected $OrderRepository;
    /**
     * OrderController constructor.
    */
    public function __construct()
    {
        $this->OrderRepository=new OrderRepository();
    }
    /**
     * Display a listing of all orders
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=$this->OrderRepository->getAllOrders(10);
        if(!count($orders))
            return $this->noResultsFound('orders');
        $additional['response']=$this->checkCountOfItems($orders,__('Orders'));
        return OrdersResource::collection($orders)->additional($additional);
    }
    /**
     * Store a new order in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $order=$this->OrderRepository->addOrder($request);
            $additional['response']=$this->responseFormat( true , 201 , __('Order saved successfully'), '');
            DB::commit();
            return (new OrderResource($order))->additional($additional)->response()->setStatusCode(201);

        }catch(\Exception $e){
            DB::rollback();
            return $this->someThingError();
        }
    }

    /**
     * Display the Order by id .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=$this->OrderRepository->getOrderById($id);
        $additional['response']=$this->checkGetItemById($order);
        if($order)
            return (new OrderResource($order))->additional($additional);
        return $additional['response'];
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $order=$this->OrderRepository->getOrderById($id);
            $additional['response']=$this->checkGetItemById($order);
            if(!$order)
                return $additional['response'];
            $order=$this->OrderRepository->updateOrderById($id,$request);
            $additional['response']=$this->responseFormat( true , 200 , __('Order updated successfully'), '');
            DB::commit();
            return (new OrderResource($order))->additional($additional);

        }catch(\Exception $e){
            DB::rollback();
            return $this->someThingError();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=$this->OrderRepository->getOrderById($id);
        $additional['response']=$this->checkGetItemById($order);
        if(!$order)
            return $additional['response'];
        $this->OrderRepository->deleteOrderById($id);
        return response()->json(['response'=>['status' => true ,'code' => 200 ,'message'=>  __('Order Deleted Successfully') ]]);    
        
    }
}

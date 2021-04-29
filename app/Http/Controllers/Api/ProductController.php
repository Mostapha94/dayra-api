<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsResource;
use App\Traits\GeneralTrait;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use GeneralTrait;
    /**
    * @var $productRepository
    */
    protected $productRepository;
    /**
     * ProductController constructor.
    */
    public function __construct()
    {
        $this->productRepository=new ProductRepository();
    }
    /**
     * Display a listing of all products
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=$this->productRepository->getAllProducts(10);
        if(!count($products))
            return $this->noResultsFound('products');
        $additional['response']=$this->checkCountOfItems($products,__('Products'));
        return ProductsResource::collection($products)->additional($additional);
    }
    /**
     * Store a new product in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $product=$this->productRepository->addProduct($request);
            $additional['response']=$this->responseFormat( true , 201 , __('Product saved successfully'), '');
            DB::commit();
            return (new ProductResource($product))->additional($additional)->response()->setStatusCode(201);

        }catch(\Exception $e){
            DB::rollback();
            return $this->someThingError();
        }
    }

    /**
     * Display the product by id .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=$this->productRepository->getProductById($id);
        $additional['response']=$this->checkGetItemById($product);
        if($product)
            return (new ProductResource($product))->additional($additional);
        return $additional['response'];
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $product=$this->productRepository->getProductById($id);
            $additional['response']=$this->checkGetItemById($product);
            if(!$product)
                return $additional['response'];
            $product=$this->productRepository->updateProductById($id,$request);
            $additional['response']=$this->responseFormat( true , 200 , __('Product updated successfully'), '');
            DB::commit();
            return (new ProductResource($product))->additional($additional);

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
        $product=$this->productRepository->getProductById($id);
        $additional['response']=$this->checkGetItemById($product);
        if(!$product)
            return $additional['response'];
        $this->productRepository->deleteProductById($id);
        return response()->json(['response'=>['status' => true ,'code' => 200 ,'message'=>  __('Product Deleted Successfully') ]]);    
        
    }
}

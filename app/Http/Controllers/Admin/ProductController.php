<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
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
        return view('backend.products.index');
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
        return view('backend.products.product_sales',['product' => $product]);
    }
     /**
     * get all products to datatable
     * @return \Illuminate\Http\Response
     */
    public function datatable(){
        return $this->productRepository->datatable();
    }
   
}

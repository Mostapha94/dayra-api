<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\SupplierRepository;

class SupplierController extends Controller
{
    /**
    * @var $supplierRepository
    */
    protected $supplierRepository;
    /**
     * SupplierController constructor.
    */
    public function __construct()
    {
        $this->supplierRepository=new SupplierRepository();
    }
    /**
     * Display a listing of all Suppliers
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.suppliers.index');
    }

    /**
     * Display the Supplier by id .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier=$this->supplierRepository->getSupplierById($id);
        if(empty($supplier))
            abort(404);
        $orders=$supplier->products->join('orders');
        return view('backend.suppliers.supplier_sales',[
            'supplier' => $supplier,
            'orders' => json_decode($orders),
        ]);
    }
     /**
     * get all Suppliers to datatable
     * @return \Illuminate\Http\Response
     */
    public function datatable(){
        return $this->supplierRepository->datatable();
    }
   
}

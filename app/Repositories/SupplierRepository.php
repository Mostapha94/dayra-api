<?php
namespace App\Repositories;
use Request;
use App\Models\Supplier;
use App\Interfaces\SupplierInterface;
/**
 * Class SupplierRepository
 * @package App\Repositories
 */
class SupplierRepository implements SupplierInterface
{
    /**
     * @var $supplier
     */
    protected $supplier;
    /**
     * SupplierRepository constructor.
     */
    public function __construct()
    {
        $this->supplier = new Supplier();
    }
    /**
     * get all suppliers
    * @return mixed
    */
    public function getAllSuppliers($per_page){
        return  $this->supplier->paginate($per_page);
    }
    /**
     * add new Supplier
    * @param Model $supplier
    * @param $request
    * @return Supplier Item
    */
    public function addSupplier($request){
        return $this->save($request,$this->supplier);
    }
    /**
    * get Supplier by id
    * @param $supplierId
    * @return Supplier Item
    */
    public function getSupplierById($supplierId){
        return $this->supplier->find($supplierId);
    }
    /**
    * update Supplier by id
    * @param $supplierId
    * @param $request
    * @return Supplier Item
    */
    public function updateSupplierById($supplierId,$request){
        $supplier = $this->supplier->find($supplierId);
        return $this->save($request,$supplier);
    }
    /**
     * delete Supplier by id
     * @param $supplierId
     */
    public function deleteSupplierById($supplierId){
        $supplier=$this->supplier->find($supplierId);
        $supplier->deleted_at = now();
        $supplier->save();
    }
    /**
    * general function to save data model
    * @param $request
    * @param Model $supplier
    * @return Supplier Item
    */
    public function save($request,$supplier){
        $supplier->fill($request->all());
        if($file   =   $request->file('image')) {
            $name=   time().time().'.'.$file->getClientOriginalExtension();
            $target_path    =   public_path('/uploads/suppliers');
            if($file->move($target_path, $name)) {
                $supplier->image=$name;
            }
        }
        $supplier->save();
        return $supplier;
    }
        /**
     * Get All car numbers to datatable
     * @return mixed
     */
    public function datatable(){
        $query = $this->supplier->query();
        $suppliers = $query->select('*');
        return datatables()->of($suppliers)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('backend.supplier.show', $row->id).'" class="btn info">'.__('Supplier Sales').'</a>  ';
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}

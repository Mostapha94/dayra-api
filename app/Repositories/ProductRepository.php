<?php
namespace App\Repositories;
use Request;
use App\Models\Product;
use App\Interfaces\ProductInterface;
/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository implements ProductInterface
{
    /**
     * @var $product
     */
    protected $product;
    /**
     * ProductRepository constructor.
     */
    public function __construct()
    {
        $this->product = new Product();
    }
    /**
     * get all products
    * @return mixed
    */
    public function getAllProducts($per_page){
        return  $this->product->where('units','>',0)->paginate($per_page);
    }
    /**
     * add new product
    * @param Model $product
    * @param $request
    * @return Product Item
    */
    public function addProduct($request){
        return $this->save($request,$this->product);
    }
    /**
    * get product by id
    * @param $productId
    * @return Product Item
    */
    public function getProductById($productId){
        return $this->product->with('supplier','category')->find($productId);
    }
    /**
    * update product by id
    * @param $productId
    * @param $request
    * @return Product Item
    */
    public function updateProductById($productId,$request){
        $product = $this->product->find($productId);
        return $this->save($request,$product);
    }
    /**
     * delete product by id
     * @param $productId
     */
    public function deleteProductById($productId){
        $product=$this->product->find($productId);
        $product->deleted_at = now();
        $product->save();
    }
    /**
    * general function to save data model
    * @param $request
    * @param Model $product
    * @return Product Item
    */
    public function save($request,$product){
        $product->fill($request->all());
        if($file   =   $request->file('image')) {
            $name=   time().time().'.'.$file->getClientOriginalExtension();
            $target_path    =   public_path('/uploads/products');
            if($file->move($target_path, $name)) {
                $product->image=$name;
            }
        }
        $product->save();
        return $product;
    }
        /**
     * Get All car numbers to datatable
     * @return mixed
     */
    public function datatable(){
        $query = $this->product->query();
        $products = $query->select('*');
        return datatables()->of($products)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('backend.product.show', $row->id).'" class="btn info">'.__('Product Sales').'</a>  ';
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}

<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface ProductInterface
 * @package App\Repositories\Interfaces
 */
interface ProductInterface
{
    /**
     * Get All products at table
     * @param $per_page
     * @return mixed
     */
    public function getAllProducts($per_page);
    /**
     * Add New Product
     * @param $per_page
     * @return mixed
     */
    public function addProduct($request);
    /**
     * Get Single Product By id
     * @param $productId
     * @return Product
     */
    public function getProductById($productId);
    /**
     * Update Single Product By Id
     * @param $productId
     * @param $request
     */
    public function updateProductById($productId,$request);
    /**
     * delete product by id
     * @param $productId
     */
    public function deleteProductById($productId);
    /**
     * datatable for all products
     */
    public function datatable();
  
}
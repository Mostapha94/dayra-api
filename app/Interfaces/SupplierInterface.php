<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface SupplierInterface
 * @package App\Repositories\Interfaces
 */
interface SupplierInterface
{
    /**
     * Get All Suppliers at table
     * @param $per_page
     * @return mixed
     */
    public function getAllSuppliers($per_page);
    /**
     * Add New Supplier
     * @param $per_page
     * @return mixed
     */
    public function addSupplier($request);
    /**
     * Get Single Supplier By id
     * @param $supplierId
     * @return Supplier
     */
    public function getSupplierById($supplierId);
    /**
     * Update Single Supplier By Id
     * @param $supplierId
     * @param $request
     */
    public function updateSupplierById($supplierId,$request);
    /**
     * delete Supplier by id
     * @param $supplierId
     */
    public function deleteSupplierById($supplierId);
    /**
     * datatable for all Suppliers
     */
    public function datatable();
  
}
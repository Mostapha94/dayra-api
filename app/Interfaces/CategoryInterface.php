<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface CategoryInterface
 * @package App\Repositories\Interfaces
 */
interface CategoryInterface
{
    /**
     * Get all categories at table
     * @param $per_page
     * @return mixed
     */
    public function getAllCategories($per_page);
    /**
     * Get Single Category By id
     * @param $categoryId
     * @return Category
     */
    public function getCategoryById($categoryId);
}
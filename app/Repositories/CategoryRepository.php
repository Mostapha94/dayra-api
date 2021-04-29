<?php
namespace App\Repositories;
use Request;
use App\Models\Category;
use App\Interfaces\CategoryInterface;
/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository implements CategoryInterface
{
    /**
     * @var $category
     */
    protected $category;
    /**
     * CategoryRepository constructor.
     */
    public function __construct()
    {
        $this->category = new Category();
    }
    /**
     * get all categories
    * @return mixed
    */
    public function getAllCategories($per_page){
        return  $this->category->paginate($per_page);
    }
    /**
    * get category by id
    * @param $categoryId
    * @return Category Item
    */
    public function getCategoryById($categoryId){
        return $this->category->find($categoryId);
    }
}

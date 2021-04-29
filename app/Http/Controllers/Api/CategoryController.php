<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoriesResource;
use App\Traits\GeneralTrait;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    use GeneralTrait;
    /**
    * @var $categoryRepository
    */
    protected $categoryRepository;
    /**
     * CategoryController constructor.
    */
    public function __construct()
    {
        $this->categoryRepository=new CategoryRepository();
    }
    /**
     * Display a listing of all categories
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=$this->categoryRepository->getAllCategories(10);
        if(!count($categories))
            return $this->noResultsFound('categories');
        $additional['response']=$this->checkCountOfItems($categories,__('Categories'));
        return CategoriesResource::collection($categories)->additional($additional);
    }
    /**
     * Display the category by id .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=$this->categoryRepository->getCategoryById($id);
        $additional['response']=$this->checkGetItemById($category);
        if($category)
            return (new CategoryResource($category))->additional($additional);
        return $additional['response'];
    }
}

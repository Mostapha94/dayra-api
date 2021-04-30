<?php

namespace App\Traits;
use App\Models\Product;

trait GeneralTrait
{
    /**
     * get all products
     */
    public function getAllProducts(){
        return Product::where('units','>',0)->paginate(20);
    }
    /**
     * Check count of items
     * @param $obj
     * @return response
     */
    public function checkCountOfItems($items,$message){
        return (count($items)?
        $this->responseFormat( true , 200 , $message ,''):
        $this->responseFormat( true , 204 , __('Sorry , no results found') ,''));
    }
     /**
     * Check count of items
     * @param $obj
     * @return response
     */
    public function checkGetItemById($obj){
        return ($obj)?
        $this->responseFormat( true , 200 , $obj['name_'.app()->getLocale()] ,''):
        response()->json(['response'=>['status' => false ,'code' => 404 ,'message'=>  __('Item not found') ]], 404 );
    }
    /**
     * return response for no results found
     * @return response
     */
    public function noResultsFound($key){
        return response()->json([$key=>[],'response'=>['status' => true ,'code' => 204 ,'message'=>  __('Sorry , no results found') ]]);
    }
    /**
     * return response for item not found
     * @return response
     */
    public function itemNotFound(){
        return response()->json(['response'=>['status' => false ,'code' => 404 ,'message'=>  __('Item not found') ]]);
    }
    /**
     * return response for some thing go wrong
     * @return response
     */
    public function someThingError(){
        return response()->json(['response'=>['status' => false ,'code' => 500 ,'message'=>  __('Some thing went wrongs !') ]], 500 );
    }
    /**
     * return response format
     * @param $status
     * @param $code
     * @param $message
     * @param $errors
     * @return response
     */
    public function responseFormat($status,$code,$message,$errors){
        if($errors != '')

            return ['response'=>['status' => $status ,'code' => $code ,'message'=> $message , 'errors'=> $errors]];
        return ['status' => $status ,'code' => $code ,'message'=> $message ];
    }
}

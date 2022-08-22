<?php

namespace App\Http\Controllers\API\V1\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Controllers\API\V1\Backend\APIController;

class CategoryController extends APIController
{
    public function index(Request $request)
    {
        $name = isset($request->name) ? $request->name : '';
        $parent_id = isset($request->parent_id) ? $request->parent_id : '';
        return CategoryResource::collection(Category::when($name,function($q) use ($name){
            $q->where('name','like',"%{$name}%");
        })->when($parent_id,function($q) use ($parent_id){
            $q->where('parent_id',$parent_id);
        })
        ->orderByDesc('id')->paginate(10));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create(collect($request->validated())->merge([
                'created_by' => auth('api')->user()->id
            ])->all());
            if($category)
            {
                return $this->sendSuccessResponse($category,'Data Has Been Saved');
            }else{
                return $this->sendErrorResponse([],'Faild To Save Data');
            }
        } catch (\Throwable $th) {
            return $this->sendErrorResponse([],$th->getMessage());
        }

    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category = $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
                'updated_by' => auth('api')->user()->id
            ]);
            if($category)
            {
                return $this->sendSuccessResponse($category,'Data Has Been Updated');
            }else{
                return $this->sendErrorResponse([],'Faild To Update Data');
            }
        } catch (\Throwable $th) {
            return $this->sendErrorResponse([],$th->getMessage());
        }
    }


    public function destroy(Category $category)
    {
        try {
            if($category->delete())
            {
                return $this->sendSuccessResponse($category,'Data Has Been Delete');
            }else{
                return $this->sendErrorResponse([],'Faild To Delete Data');
            }
        } catch (\Throwable $th) {
            return $this->sendErrorResponse([],$th->getMessage());
        }
    }

    public function category_list()
    {
        $categories = Category::select('id','name')->where('status',1)->get();
        if(!$categories->isEmpty())
        {
            return $this->sendSuccessResponse($categories);
        }else{
            return $this->sendErrorResponse([],'No Data Found Data');
        }

    }
}

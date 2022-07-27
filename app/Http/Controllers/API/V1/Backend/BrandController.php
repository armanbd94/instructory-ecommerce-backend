<?php

namespace App\Http\Controllers\API\V1\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BrandRequest;
use App\Http\Resources\Brand\BrandResource;
use App\Http\Controllers\API\V1\Backend\APIController;

class BrandController extends APIController
{
    public function index(Request $request)
    {
        $name = isset($request->name) ? $request->name : '';
        return BrandResource::collection(Brand::when($name,function($q) use ($name){
            $q->where('name','like',"%{$name}%");
        })->orderByDesc('id')->paginate(10));
    }

    public function store(BrandRequest $request)
    {
        try {
            $brand = Brand::create(collect($request->validated())->merge([
                'created_by' => auth('api')->user()->id
            ])->all());
            if($brand)
            {
                return $this->sendSuccessResponse($brand,'Data Has Been Saved');
            }else{
                return $this->sendErrorResponse([],'Faild To Save Data');
            }
        } catch (\Throwable $th) {
            return $this->sendErrorResponse([],$th->getMessage());
        }

    }

    public function update(BrandRequest $request, Brand $brand)
    {
        try {
            $brand = $brand->update([
                'name' => $request->name,
                'created_by' => auth('api')->user()->id
            ]);
            if($brand)
            {
                return $this->sendSuccessResponse($brand,'Data Has Been Updated');
            }else{
                return $this->sendErrorResponse([],'Faild To Update Data');
            }
        } catch (\Throwable $th) {
            return $this->sendErrorResponse([],$th->getMessage());
        }
    }


    public function destroy(Brand $brand)
    {
        try {
            if($brand->delete())
            {
                return $this->sendSuccessResponse($brand,'Data Has Been Delete');
            }else{
                return $this->sendErrorResponse([],'Faild To Delete Data');
            }
        } catch (\Throwable $th) {
            return $this->sendErrorResponse([],$th->getMessage());
        }
    }
}

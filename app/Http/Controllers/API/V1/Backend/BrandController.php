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
        return BrandResource::collection(Brand::orderByDesc('id')->paginate(10));
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

    public function edit(Brand $brand)
    {
        //
    }

    public function update(BrandRequest $request, Brand $brand)
    {

    }


    public function destroy(Brand $brand)
    {

    }
}

<?php

namespace App\Http\Controllers\API\V1\Backend;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Resources\SupplierResource;
use App\Http\Requests\Admin\SupplierRequest;
use App\Http\Controllers\API\V1\Backend\APIController;

class SupplierController extends APIController
{
    public function index(Request $request)
    {
        $name = isset($request->name) ? $request->name : '';
        $mobile_no = isset($request->mobile_no) ? $request->mobile_no : '';
        return SupplierResource::collection(Supplier::with('createdBy')
        ->when($name,function($q) use ($name){
            $q->where('name','like',"%{$name}%");
        })
        ->when($mobile_no,function($q) use ($mobile_no){
            $q->where('mobile_no','like',"%{$mobile_no}%");
        })
        ->orderByDesc('id')->paginate(10));
    }

    public function store(SupplierRequest $request)
    {
        try {
            $supplier = Supplier::create(collect($request->validated())->merge([
                'created_by' => auth('api')->user()->id
            ])->all());
            if($supplier)
            {
                return $this->sendSuccessResponse($supplier,'Data Has Been Saved');
            }else{
                return $this->sendErrorResponse([],'Faild To Save Data');
            }
        } catch (\Throwable $th) {
            return $this->sendErrorResponse([],$th->getMessage());
        }

    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        try {
            $supplier = $supplier->update(collect($request->validated())->merge([
                'updated_by' => auth('api')->user()->id
            ])->all());
            if($supplier)
            {
                return $this->sendSuccessResponse($supplier,'Data Has Been Updated');
            }else{
                return $this->sendErrorResponse([],'Faild To Update Data');
            }
        } catch (\Throwable $th) {
            return $this->sendErrorResponse([],$th->getMessage());
        }
    }


    public function destroy(Supplier $supplier)
    {
        try {
            if($supplier->delete())
            {
                return $this->sendSuccessResponse($supplier,'Data Has Been Delete');
            }else{
                return $this->sendErrorResponse([],'Faild To Delete Data');
            }
        } catch (\Throwable $th) {
            return $this->sendErrorResponse([],$th->getMessage());
        }
    }
}

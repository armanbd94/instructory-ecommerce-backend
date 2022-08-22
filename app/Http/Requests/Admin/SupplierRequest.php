<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => ['required','unique:suppliers,name'],
            'mobile_no' => ['required','unique:suppliers,mobile_no'],
            'address' => ['nullable'],
        ];
        if(request()->id)
        {
            $rules['name'][1] = 'unique:suppliers,name,'.request()->id;
            $rules['mobile_no'][1] = 'unique:suppliers,mobile_no,'.request()->id;
        }
        return $rules;
    }
}

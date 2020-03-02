<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessListingRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case "POST":
                return [
                    'name' => 'required|unique:business_listings,name',
                    'description' => 'required',
                    'category_id' => 'required',
                    'image' => 'required',
                ];
                break;
            case "PATCH":
                $id = request()->id;
                return [
                    'name' => 'required|unique:business_listings,name,' . $id,
                    'category_id' => 'required',
                    'description' => 'required',
                ];
                break;
        }
    }
}

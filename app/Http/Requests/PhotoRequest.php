<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
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
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'discount' => ['nullable','integer'],
            'file' => ['required', 'image', 'max:7000'],
            'private' => ['required', 'in:0,1', 'integer']
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'price' => (int) filter_var($this->price, FILTER_SANITIZE_NUMBER_INT),
            'discount' => (int) filter_var($this->discount, FILTER_SANITIZE_NUMBER_INT),
        ]);
    }
}

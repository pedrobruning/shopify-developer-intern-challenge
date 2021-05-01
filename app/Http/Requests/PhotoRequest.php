<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'price' => ['required', 'integer', 'gte:discount'],
            'discount' => ['nullable','integer'],
            'file' => [
                Rule::requiredIf(function() {
                    return empty($this->path);
                }),
                'image',
                'max:7000'
            ],
            'path' => [
                Rule::requiredIf(function() {
                    return empty($this->file);
                }),
                'string'
            ],
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
            'price' => intval(number_format(floatval($this->price), 2, '', '')),
            'discount' => intval(number_format(floatval($this->discount), 2, '', '')),
        ]);
    }
}

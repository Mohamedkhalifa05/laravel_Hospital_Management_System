<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;


class StoreSingleServiceRequest extends FormRequest
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
            'name' => 'required|unique:service_translations,name,'.$this->id.',Service_id',
            'price' => 'numeric|required',
            'description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.unique' => trans('validation.unique'),
            'price.required' => trans('validation.required'),
            'price.numeric' => trans('validation.numeric'),
        ];
    }
    protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(
        redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('open_service_modal', $this->id ? 'edit' : 'add')
            ->with('service_id', $this->id)
    );
}
}

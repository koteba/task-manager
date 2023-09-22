<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:80|unique:statuses,name',
            'notes' => 'max:1000'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'يجب أن تدخل الحالة ',
            'name.unique' => '  يجب أن تكون الحالة فريدة',
            'notes.max' => ' يجب أن لا يكون طول الملاحظات أكثر من 1000',
            'name.max' => ' يجب أن لا يكون طول الحالة أكثر من 80'
        ];
    }
}

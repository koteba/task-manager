<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->user_type == 1;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // $id = $this->route('category'); // Assuming 'category' is the name of the route parameter.
    
        return [
            'name' => 'required|string|max:80',
            'notes' => 'max:1000'
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'يجب أن تدخل اسم الصنف ',
            'name.max' => ' يجب أن لا يكون طول الصنف أكثر من 80',
            'name.unique' => 'هذا الصنف موجود بالفعل، يجب أن يكون فريدًا.',  
            'notes.max' => ' يجب أن لا يكون طول الملاحظات أكثر من 1000'
        ];
    }
}

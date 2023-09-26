<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Http\FormRequest;
class TaskRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:80',
            ],
            'notes' => 'max:1000',
            'status_id' => 'required',
            'project_id' => 'integer', 
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'user_ids' => 'required|array',
            'description' => 'nullable|string',
        ];
    }
    
    
    public function messages()
    {
        return [
            'name.required' => 'يجب أن تدخل اسم المهمة ',
            'status_id.required' => 'يجب أن تدخل اسم الحالة ',
            'start_date.required' => 'يجب أن تدخل تاريخ بداية المهمة  ',
            'end_date.required' => 'يجب أن تدخل تاريخ نهاية المهمة  ',
            'end_date.after' => 'يجب أن يكون تاريخ نهاية المهمة أكبر من تاريخ البداية  ',
            'user_ids.required' => 'يجب أن تدخل اسم المستخدم ',
            'name.max' => ' يجب أن لا يكون طول المهمة أكثر من 80',
            'name.unique' => 'هذا الصنف موجود بالفعل، يجب أن يكون فريدًا.',  
            'notes.max' => ' يجب أن لا يكون طول الملاحظات أكثر من 1000'
        ];
    }
}

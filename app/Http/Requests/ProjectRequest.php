<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'required|string|max:80|unique:projects,name',
            'notes' => 'max:1000',
            'status_id' => 'required|in:pending,IN PROGRESS,APPROVED,REJECTED',
            'category_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'user_ids' => 'required',
            'description' => 'nullable|string',

        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'يجب أن تدخل اسم المشروع ',
            'status_id.required' => 'يجب أن تدخل اسم الحالة ',
            'start_date.required' => 'يجب أن تدخل تاريخ  بداية المشروع ',
            'end_date.required' => 'يجب أن تدخل تاريخ  نهاية المشروع ',
            'end_date.after' => 'يجب أن يكون تاريخ  نهاية المشروع اكبر من تاريخ البداية',
            'category_id.required' => 'يجب أن تدخل تصنيف المشروع ',
            'user_ids.required' => 'يجب أن تدخل اسم المستخدم ',
            'name.max' => ' يجب أن لا يكون طول المشروع أكثر من 80',
            'name.unique' => 'هذا المشروع موجود بالفعل، يجب أن يكون فريدًا.',  
            'notes.max' => ' يجب أن لا يكون طول الملاحظات أكثر من 1000'
        ];
    }
}

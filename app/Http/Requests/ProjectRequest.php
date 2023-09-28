<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class ProjectRequest extends FormRequest
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
            'name' => 'required|string|max:40',
            'image' => 'max:2048|mimes:jpeg,jpg,png',
            'client' => 'string|max:20',
            'budget' => 'required',
            'notes' => 'max:200',
            'status_id' => 'required',
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
            'image.max' => 'يجب أن يكون حجم الصورة اقل من 2048 ',
            'image.mimes' => ' jpg,jpeg,png يجب أن يكون  الصورة من نوع  ',
            'budget.required' => 'يجب أن تدخل ميزانية المشروع ',
            'status_id.required' => 'يجب أن تدخل اسم الحالة ',
            'start_date.required' => 'يجب أن تدخل تاريخ  بداية المشروع ',
            'end_date.required' => 'يجب أن تدخل تاريخ  نهاية المشروع ',
            'end_date.after' => 'يجب أن يكون تاريخ  نهاية المشروع اكبر من تاريخ البداية',
            'category_id.required' => 'يجب أن تدخل تصنيف المشروع ',
            'user_ids.required' => 'يجب أن تدخل اسم المبرمج ',
            'name.max' => ' يجب أن لا يكون اسم المشروع أكثر من 40',
            'client.max' => ' يجب أن لا يكون زبون المشروع أكثر من 20',
            'notes.max' => ' يجب أن لا يكون طول الملاحظات أكثر من 200',
        ];
    }
}

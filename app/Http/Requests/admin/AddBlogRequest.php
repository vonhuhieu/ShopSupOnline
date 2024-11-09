<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AddBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:200',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
            'description' => 'required|max:200',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được nhập quá :max ký tự',
            'image' => ':attribute sai định dạng',
            'mimes' => ':attribute chỉ cho phép dạng jpg, jpeg, gif hoặc png',
            'image.max' => ':attribute chỉ cho phép dung lượng dưới 1MB',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề',
            'image' => 'Hình ảnh',
            'description' => 'Mô tả',
            'content' => 'Nội dung',
        ];
    }
}

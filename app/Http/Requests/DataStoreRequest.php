<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataStoreRequest extends FormRequest
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
            'title' => 'required|string|max:20',
            'category' => 'required|in:カテゴリ１,カテゴリ２,カテゴリ３',
            'content' => 'required|string|max:200',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'title' => 'タイトル',
            'category' => 'カテゴリ',
            'content' => '本文',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは20文字以内で入力してください',
            'category.required' => 'カテゴリを入力してください',
            'category.in' => 'カテゴリは不正な値です',
            'content.required' => '本文を入力してください',
            'content.max' => '本文は200文字以内で入力してください',
        ];
    }
}

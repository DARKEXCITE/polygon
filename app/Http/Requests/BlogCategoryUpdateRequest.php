<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryUpdateRequest extends FormRequest
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
            'title'     => 'required|min:3|max:150',
            'slug'      => 'max:150',
            'parent_id' => 'required|integer|exists:blog_categories,id'
        ];
    }

    /**
     * Сообщения валидации об ошибках
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'        => 'Введите заголовок категории',
            'title.min'             => 'Минимальное количество символов заголовка: :min',
            'title.max'             => 'Максимальное количество символов заголовка: :max',
            'slug.max'              => 'Максимальное количество символов идентификатора: :max'
        ];
    }
}

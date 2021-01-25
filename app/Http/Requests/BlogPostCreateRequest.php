<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
            'title'         => 'required|min:3|max:200',
            'slug'          => 'max:200',
            'category_id'   => 'required|integer|exists:blog_categories,id',
            'content_raw'   => 'required|min:100|max:10000',
            'excerpt'       => 'min:10|max:250'
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
            'title.required'            => 'Введите заголовок поста',
            'title.min'                 => 'Минимальное количество символов заголовка: :min',
            'title.max'                 => 'Максимальное количество символов заголовка: :max',
            'slug.max'                  => 'Максимальное количество символов идентификатора: :max',
            'content_raw.min'           => 'Минимальное количество символов поста: :min',
            'content_raw.max'           => 'Максимальное количество символов поста: :max',
            'content_raw.required'      => 'Введите содержание поста',
            'excerpt.min'               => 'Минимальное количество символов отрывка: :min',
            'excerpt.max'               => 'Максимальное количество символов отрывка: :max'
        ];
    }
}

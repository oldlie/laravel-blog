<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostStoreRequest extends Request
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
     * https://laravel.com/docs/5.4/validation#quick-defining-the-routes
     *
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "author" => "required | max:255",
            "publisher" => "required | max:255",
            "editor" => "required | max:255",
            "page_image" => "required",
            "meta_description" => "required | max:255"
        ];
    }
}

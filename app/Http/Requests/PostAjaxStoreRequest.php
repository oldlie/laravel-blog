<?php

namespace App\Http\Requests;

class PostAjaxStoreRequest extends Request
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
            "slug" => "require | unique:posts,slug",
            "title" => "require",
            "content_raw" => "require"
        ];
    }
}

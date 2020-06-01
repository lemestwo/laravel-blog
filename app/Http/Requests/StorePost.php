<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'title' => 'required|min:10',
            'summary' => 'required|min:10',
            'content' => 'required|min:10',
            'publish' => 'nullable|regex:/^\d{2}\/\d{2}\/\d{4}\ \d{2}\:\d{2}$/|date_format:d/m/Y H:i'
        ];
    }
}

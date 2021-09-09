<?php

namespace App\Domains\Master\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ClusterRequest.
 */
class ClusterRequest extends FormRequest
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
            'nama' => ['required', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'formula' => ['max:255'],
        ];
    }
    public function messages()
    {
        return [
            'nama.regex' => __('Cannot use special char on name!'),
        ];
    }
}

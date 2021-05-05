<?php

namespace App\Domains\AktaNotaris\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AktaNotarisRequest.
 */
class AktaNotarisRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'couple_name' => ['max:255'],
            'address' => ['max:1000'],
            'domicile' => ['max:1000'],
        ];
    }
}

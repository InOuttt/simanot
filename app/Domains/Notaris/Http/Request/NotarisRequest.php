<?php

namespace App\Domains\Notaris\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NotarisRequest.
 */
class NotarisRequest extends FormRequest
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

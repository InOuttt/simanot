<?php

namespace App\Domains\Master\Http\Requests;

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
            'nama' => ['required', 'max:255'],
            'partner_id' => ['max:255'],
            'alamat' => ['max:1000'],
            'domisili' => ['max:1000'],
        ];
    }
}

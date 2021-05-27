<?php

namespace App\Domains\AktaNotaris\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AktaNotarisRequest.
 */
class AktaNoteRequest extends FormRequest
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
    protected function prepareForValidation()
    {
        // dd($this->all());
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_akta_hutang' => ['required', 'max:255'],
            'type' => ['required', 'in:surat,telp,email'],
            'tanggal_note' => ['date', 'date_format:Y-m-d'],
            'note' => ['string']
        ];
    }

}

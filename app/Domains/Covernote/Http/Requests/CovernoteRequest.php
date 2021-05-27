<?php

namespace App\Domains\Covernote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CovernoteRequest.
 */
class CovernoteRequest extends FormRequest
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
            'notaris_id' => ['required', 'max:255'],
            'no_covernote' => ['required', 'string', 'max:255'],
            'tanggal_covernote' => ['date', 'date_format:Y-m-d'],
            'durasi' => ['numeric'],
            'jatuh_tempo' => ['date', 'date_format:Y-m-d'],
            'os' => ['numeric'],
            'is_perpanjangan_sertifikat' => ['in:0,1'],
            'cluster_id' => ['string', 'nullable'],
            'nama_debitur' => ['string'],
        ];
    }

}

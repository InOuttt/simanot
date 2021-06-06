<?php

namespace App\Domains\Letter\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GrupHukumRequest.
 */
class GrupHukumRequest extends FormRequest
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
            'cluster_id' => ['required', 'max:255'],
            'bulan' => ['required', 'numeric'],
            'tahun' => ['required', 'numeric'],
            'tanggal_email' => ['required', 'date', 'date_format:Y-m-d'],
            'file_id' => ['numeric', 'nullable'],
        ];
    }

}

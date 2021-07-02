<?php

namespace App\Domains\Covernote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CovernoteDocumentRequest.
 */
class CovernoteDocumentRequest extends FormRequest
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
            'status_dokumen' => ['in:0,1,2'],
            'jumlah_salinan' => ['numeric', 'nullable'],
            'nomor_dokumen' => ['string', 'max:255', 'nullable'],
            'tanggal_terbit' => ['date', 'date_format:Y-m-d', 'nullable'],
            'tanggal_terima' => ['date', 'date_format:Y-m-d', 'nullable'],
            'tanggal_selesai' => ['date', 'date_format:Y-m-d', 'nullable'],
            'tanda_terima_notaris' => [ 'nullable'],
            'tanda_terima_debitur' => [ 'nullable'],
        ];
    }

}

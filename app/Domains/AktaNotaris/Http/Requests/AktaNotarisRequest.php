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
            'id_notaris' => ['required', 'max:255'],
            'no_covernote' => ['required', 'string', 'max:255'],
            'tanggal_covernote' => ['date', 'date_format:Y-m-d'],
            'durasi' => ['numeric'],
            'jatuh_tempo' => ['date', 'date_format:Y-m-d'],
            'os' => ['numeric'],
            'is_perpanjangan_sertifikat' => ['in:Y,T'],
            'cluster' => ['string', 'nullable'],
            'nama_debitur' => ['string'],
            'nama_dokumen' => ['string'],
            'nomor_tanggal_dokumen' => ['string'],
            'status_dokumen' => ['in:terima,belum terima'],
            'tanggal_terima_dokumen' => ['date_format:Y-m-d', 'nullable'],
            'jumlah_salinan' => ['numeric', 'nullable'],
            'tanggal_selesai' => ['date_format:Y-m-d', 'nullable'],
            'tanggal_kirim_salinan' => ['date_format:Y-m-d', 'nullable'],
        ];
    }

}

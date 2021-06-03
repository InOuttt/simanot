<?php

namespace App\Domains\Covernote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CovernoteDocumentRequest.
 */
class CovernoteFollowupRequest extends FormRequest
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
            'covernote_dokumen_id' => ['numeric', 'nullable'],
            'type' => ['in:telp,email,surat'],
            'tanggal_followup' => ['required', 'date', 'date_format:Y-m-d'],
            'hasil' => ['required'],
        ];
    }

}

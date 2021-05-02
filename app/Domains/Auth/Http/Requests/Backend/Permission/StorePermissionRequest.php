<?php

namespace App\Domains\Auth\Http\Requests\Backend\Permission;

use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StorePermissionRequest.
 */
class StorePermissionRequest extends FormRequest
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
            'type' => ['required', Rule::in([User::TYPE_ADMIN, User::TYPE_USER])],
            'name' => ['required', 'max:255', 'unique'],
            'guard_name' => ['max:255'],
            'parent_id.*' => [Rule::exists('permissions', 'id')->where('type', $this->type)],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'parent_id.*.exists' => __('One or more permissions parent were not found.'),
        ];
    }
}

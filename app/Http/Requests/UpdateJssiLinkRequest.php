<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJssiLinkRequest extends FormRequest
{
    private int $menuId;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'menu_id' => 'required|integer',
            'title' => 'required|string',
            'link' => 'required|string|unique:jssi_links' . ($this->menuId ? ",id,$this->menuId" : ''),
            'visible' => 'required|boolean'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->menuId = $this->request->get('menu_id');
    }
}

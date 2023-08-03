<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateJssiMenuRequest extends FormRequest
{
    /**
     * @var int $menuId
     */
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
            'title' => 'required|string',
            'alias' => 'required|string|unique:jssi_menus' . ($this->menuId ? ",id,$this->menuId" : ''),
            'visible' => 'required|boolean',
            'menu_id' => 'required|integer'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->menuId = $this->request->get('menu_id');
    }
}

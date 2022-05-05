<?php

namespace App\Http\Requests;

use App\Enums\CurrencyTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CurrencyConvertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'source' => ['required', new Enum(CurrencyTypes::class)],
            'target' => ['required', new Enum(CurrencyTypes::class)],
            'amount' => ['required', 'numeric', 'min:0']
        ];
    }
}

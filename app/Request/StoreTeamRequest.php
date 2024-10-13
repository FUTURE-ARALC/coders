<?php

declare(strict_types=1);

namespace App\Request;

use App\Enum\TypesEnum;
use Hyperf\Validation\Request\FormRequest;

class StoreTeamRequest extends AbstractTeamRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $validTypes = implode(',',array_values(array_column(TypesEnum::cases(),'value')));

        return [
            'name' => 'required|string|unique:teams,name',
            'type' => "required|string|in:{$validTypes}",
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'name is required brow',
            'type.required' => 'type is required brow',
        ];
    }

    public function getName()
    {
        return $this->input('name');
    }

    public function getType()
    {
        return $this->input('type');
    }



}

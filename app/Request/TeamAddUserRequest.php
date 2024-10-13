<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class TeamAddUserRequest extends FormRequest
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
        return [
            'users' => 'required|array', 
            'users.*' => 'integer|exists:users,id',      
        ];
    }

    public function getUsers() 
    {
        return $this->input('users');
    }


}

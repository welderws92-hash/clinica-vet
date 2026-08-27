<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'animal_id'=>'required','exists:animals,id',
            'title'=>'required','string','max:255',
            'issue_date'=>'required','date',
            'file_path' => 'required','file','mimes:pdf,jpg,jpeg,png','max:2048',
            'description'=>'nullable','string',
        ];
        if($this->isMethod('POST')){
            $rules['file']=['required','file','mimes:pdf,jpg,png,jpeg','max:2048'];
        }else {
             $rules['file']=['nullable','file','mimes:pdf,jpg,png,jpeg','max:2048'];
        }
        return $rules;
        }
    }


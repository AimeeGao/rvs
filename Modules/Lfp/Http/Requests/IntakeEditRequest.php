<?php

namespace Modules\Lfp\Http\Requests;

use Override;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IntakeEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    #[Override]
    public function messages(): array {
        return [
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array {
        return [
            'id' => 'required',
            'sin' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'alias_name' => 'nullable',
            'profession' => 'nullable',
            'employer' => 'nullable',
            'community' => 'nullable',
            'employment_status' => 'nullable',
            'intake_status' => 'nullable',
            'in_good_standing' => 'nullable',
            'repayment_start_date' => 'nullable|date_format:Y-m-d',
            'receive_date' => 'nullable|date_format:Y-m-d',
            'proposed_registration_date' => 'nullable|date_format:Y-m-d',
            'denial_reason' => 'nullable',
            'amount_owing' => 'nullable|numeric',
            'comment' => 'nullable|string',
            'both_eligibility_status' => 'required|boolean',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    #[Override]
    protected function prepareForValidation(): void {
        $this->merge(['sin' => str_replace(' ', '', ($this->sin))]);

        // Convert both_eligibility_status to boolean
        if ($this->has('both_eligibility_status')) {
            $this->merge(['both_eligibility_status' => filter_var($this->both_eligibility_status, FILTER_VALIDATE_BOOLEAN)]);
        }
    }
}

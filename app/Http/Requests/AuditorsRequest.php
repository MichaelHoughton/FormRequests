<?php

namespace App\Http\Requests;

use App\Auditor;
use Illuminate\Foundation\Http\FormRequest;

class AuditorsRequest extends FormRequest
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
            'name' => 'required',
            'company' => 'required',
            'address.suburb' => 'required_with:address.address_1',
            'address.post_code' => 'required_with:address.address_1|max:10',
            'address.state' => 'required_with:address.address_1',
            'address.country' => 'required_with:address.address_1',
        ];
    }

    /**
     * Custom Messages
     * @return array
     */
    public function messages()
    {
        return [
            'address.suburb.required_with' => 'The suburb field is required.',
            'address.post_code.required_with' => 'The post code field is required.',
            'address.post_code.max' => 'The post code may not be greater than 10 characters.',
            'address.state.required_with' => 'The state is required.',
            'address.country.required_with' => 'The country is required.',
        ];
    }

    /**
     * Adds an auditor
     * @return \App\Auditor
     */
    public function addAuditor()
    {
        $auditor = Auditor::create($this->all());

        if ($this->address['address_1']) {
            $auditor->address()
                ->create($this->address);
        }

        return $auditor;
    }

    public function updateAuditor(Auditor $auditor)
    {
        $auditor->update($this->all());

        // lets see if there is an address
        if ($this->address['address_1']) {
            $auditor->address()
                ->create($this->address);
        } else {
            // lets delete any previously saved addresses
            $auditor->address()
                ->delete();
        }

        return $auditor;
    }
}

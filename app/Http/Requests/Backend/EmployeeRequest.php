<?php
namespace App\Http\Requests\Backend;
use Illuminate\Foundation\Http\FormRequest;
class EmployeeRequest extends FormRequest
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
        $rules = [
            'name'=>'required|min:3',
            'email' => 'required|unique:employees,email,'.$this->id,
            'salary'=>'required|numeric',
            'image'   => 'image|mimes:jpeg,png,jpg,gif',
            'mobile'=>'required',
            'address'=>'required'
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter category name!',
            'email.required' => 'Please enter email!',
            'salary.required' => 'Please enter salary!',
            'mobile.required' => 'Please enter mobile no!',
            'image.required' => 'Please select image!',
            'address.required' => 'Please enter address!'
        ];
    }
}

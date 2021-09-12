<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelReviewsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //todo fix validation error
        try{
            $yearsRule = date('Y-m-d', strtotime('-2 years'));
            return [
                'from' => 'bail|required|date|date_format:Y-m-d|after_or_equal:' . $yearsRule,
                'to' => 'bail|required|date|date_format:Y-m-d|before_or_equal:' . date('Y-m-d')
            ];
        }catch (\Exception $ex) {
            dd($ex->getMessage());
        }

    }

    protected function prepareForValidation()
    {

    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            "from.required" => "from is required.",
            "to.required" => "to is required.",
            "from.date_format" => "from date format should follow Y-m-d",
            "to.date_format" => "to date format should follow Y-m-d",
        ];
    }
}

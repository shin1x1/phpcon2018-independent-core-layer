<?php
declare(strict_types=1);

namespace Acme\Point\Application\AddPointDomain\Actions;

use Illuminate\Foundation\Http\FormRequest;

class AddPointRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|int',
            'add_point'   => 'required|int',
        ];
    }
}

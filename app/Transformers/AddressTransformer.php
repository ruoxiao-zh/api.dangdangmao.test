<?php

namespace App\Transformers;

use App\Models\Address;
use League\Fractal\TransformerAbstract;

class AddressTransformer extends TransformerAbstract
{
    public function transform(Address $address)
    {
        return [
            'id'               => $address->Id,
            'user_id'          => $address->UserId,
            'receive_name'     => $address->ReceiveName,
            'province'         => $address->Province,
            'city'             => $address->City,
            'address'          => $address->Address,
            'county'           => $address->County,
            'complete_address' => $address->completeAddress(),
            'post_code'        => $address->PostCode,
            'mobile'           => $address->Mobile,
            'is_default'       => (boolean)$address->IsDefault,
            'add_date'         => $address->AddDate,
        ];
    }
}

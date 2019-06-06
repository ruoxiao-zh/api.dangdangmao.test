<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id'         => $user->ID,
            'phone'      => $user->UserId,
            'order'      => $user->userType,
            'true_name'  => $user->TrueName,
            'created_at' => $user->createdtime,
            'updated_at' => $user->update_time,
        ];
    }
}

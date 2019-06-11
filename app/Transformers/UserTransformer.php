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
            'true_name'  => $user->TrueName,
            'nickname'   => $user->Nickname,
            'avatar'     => $user->AvatarUrl,
            'introduce'  => $user->introduce,
            'sex'        => $user->Sex,
            'order'      => $user->userType,
            'created_at' => $user->createdtime,
            'updated_at' => $user->update_time,
        ];
    }
}

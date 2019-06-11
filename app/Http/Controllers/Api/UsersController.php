<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use App\Transformers\UserTransformer;

class UsersController extends Controller
{
    public function update(UserRequest $request)
    {
        User::where('ID', $this->user()->ID)->update($request->all());

        return $this->response->item(User::find($this->user()->ID), new UserTransformer());
    }
}

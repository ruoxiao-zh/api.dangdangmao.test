<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserIntegral;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function exchangeCoupon(Request $request, UserIntegral $userIntegral)
    {
        $userIntegralInfo = $userIntegral->where('mid', $this->user()->Id)->find();
        dd($request->all());
    }
}

<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Api\Admin\User\UserChangePasswordRequest;
use App\Http\Requests\Api\Admin\User\UserRechargeRequest;
use App\Http\Requests\Api\Admin\User\UserRequest;
use App\Http\Requests\Api\Admin\User\UsersAddRecommendedPlacesRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::filter($request->all())->paginate($request->get('per_page', 20));

        return $this->response->paginator($users, new UserTransformer());
    }

    public function show(User $user)
    {
        return $this->response->item($user, new UserTransformer());
    }

//    public function store(UserRequest $request, User $user)
//    {
//        $user->fill($request->all());
//        $user->save();
//
//        return $this->response->item($user, new UserTransformer())->setStatusCode(201);
//    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        return $this->response->item($user, new UserTransformer());
    }

    public function delete(User $user)
    {
        $user->delete();

        return $this->response->noContent();
    }

    public function export(UsersExport $usersExport)
    {
        return $usersExport;
    }

    public function recharge(UserRechargeRequest $request)
    {
        if ($userWalletMoney = UserWalletMoney::where('uid', $request->id)->first()) {
            // 添加商家保障金
            $userWalletMoney->increment('money_balance', $request->money);
            $userWalletMoney->remark = $request->remark;
            $userWalletMoney->save();

            $money_prebalance = $userWalletMoney->money_balance - $request->money;
        } else {
            UserWalletMoney::firstOrCreate([
                'uid'           => (int)$request->id,
                'money_balance' => $request->money,
                'remark'        => $request->remark,
            ]);
            $money_prebalance = 0;
        }

        $this->addUserWalletLog($money_prebalance);

        return $this->response->array(['recharge_result' => 'success'])->setStatusCode(200);
    }

    // 添加商家保障金购买记录
    private function addUserWalletLog(float $money_prebalance)
    {
        UserWallet::create([
            'uid'              => request()->id,
            'order_id'         => time() . request()->id,
            'money_cost'       => request()->money,
            'status'           => 1,
            'type'             => 1,
            'addtime'          => time(),
            'createdtime'      => Carbon::now()->toDateTimeString(),
            'money_balance'    => $money_prebalance + request()->money,
            'money_prebalance' => $money_prebalance,
            'buy_member_phone' => $this->user()->mobile,
            'remark'           => '用户 ' . $this->user()->mobile . ' 在本店充值' . request()->money . '元',
        ]);
    }

    public function changePassword(UserChangePasswordRequest $request, User $user)
    {
        switch ($request->type) {
            case 'login':
                $user->update(['Password' => md5($request->password)]);
                break;

            case 'trade':
                $user->update(['LevIIPwd' => md5($request->password)]);
                break;
        }

        return $this->response->item($user, new UserTransformer());
    }

    public function addRecommendedPlaces(UsersAddRecommendedPlacesRequest $request, UserLevelPlaceAddNumLog $userLevelPlaceAddNumLog)
    {
        $userActivateType = UserActivateType::where('uid', (int)$request->id)->where('user_type', (int)$request->user_type_id)->first();
        if ($userActivateType) {
            $userActivateType->increment('buy_num', (int)$request->buy_num);
        } else {
            UserActivateType::create([
                'uid'       => (int)$request->id,
                'user_type' => (int)$request->user_type_id,
                'buy_num'   => (int)$request->buy_num,
            ]);
        }

        $userLevelPlaceAddNumLog->remark = Carbon::now()->toDateTimeString() . ' 用户 ID: ' . $request->user_type_id . ' 添加' .
            UserType::where('ID', (int)$request->user_type_id)->value('Name') . '购买名额 ' . $request->buy_num . ' 人';
        $userLevelPlaceAddNumLog->save();

        return $this->response->item(User::find((int)$request->id), new UserTransformer());
    }
}

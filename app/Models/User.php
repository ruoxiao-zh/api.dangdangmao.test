<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// 采购商城会员信息基本表
class User extends Authenticatable implements JWTSubject
{
    use Notifiable, Filterable;

    protected $table = 'usermsg';

    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'password', 'IsAudit', 'is_integral_store', 'is_operation', 'refuse_reason',
        'Password', 'LevIIPwd'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    // 账户余额
    public function moneyBalance()
    {
        return $this->hasOne(UserWalletMoney::class, 'uid', 'ID');
    }

    // 所属级别
    public function userTypeInfo()
    {
        return $this->belongsTo(UserType::class, 'user_type', 'ID');
    }

    // 商户激活名额统计
    public function userActivateType()
    {
        return $this->hasMany(UserActivateType::class, 'uid', 'ID')->select('user_type', 'give_num', 'buy_num');
    }

    // 推荐名额详情
    public function userActivateTypeDetail()
    {
        $data = [];
        foreach (UserType::all() as $value) {
            if ($userActivateType = UserActivateType::where('uid', $this->ID)->where('user_type', $value->ID)->first()) {

                $res['give_num'] = $userActivateType->give_num;
                $res['buy_num'] = $userActivateType->buy_num;
            } else {
                $res['give_num'] = 0;
                $res['buy_num'] = 0;
            }
            $res['user_type_id'] = $value->ID;
            $res['user_type_name'] = $value->Name;

            $data[] = $res;
        }

        return $data;
    }

    // 商家提现账户金额余额
    public function depositMoney()
    {
        return $this->hasOne(UserDeposit::class, 'uid', 'ID');
    }

    // 商家提现记录
    public function alreadyDepositMoney()
    {
        return $this->hasOne(UserDepositLog::class, 'uid', 'ID');
    }

    // 状态
    public function status(int $isLock = 0, int $isAudit = 0): string
    {
        if ($isLock) {
            switch ($isAudit) {
                case 0:
                    return '未审核';
                    break;

                case 1:
                    return '审核通过';
                    break;

                case 2:
                    return '审核未通过';
                    break;

                case 3:
                    return '审核中';
                    break;
            }
        } else {
            return '未激活';
        }
    }

    // 所属事业部
    public function businessDivisionGroup()
    {
        return $this->belongsTo(BusinessDivisionGroup::class, 'group_id', 'id');
    }

    // 积分商城状态
    public function integralStoreStatus()
    {
        switch ($this->is_integral_store) {
            case 1:
                return '已开通';
                break;

            case 2:
                return '没有开通';
                break;

            case 3:
                return '上传线下凭证未审核';
                break;

            case 4:
                return '审核未通过';
                break;
        }
    }
}

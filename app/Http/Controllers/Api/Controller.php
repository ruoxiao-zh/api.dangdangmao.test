<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Controller extends BaseController
{
    use Helpers;

    // 缓存配置
    protected $user_search_keywords_cache_key = 'dangdangmao_user_search_keywords_';
    protected $search_keywords_weight_cache_key = 'dangdangmao_search_keywords_weight';

    public function errorResponse($statusCode, $message = null, $code = 0)
    {
        throw new HttpException($statusCode, $message, null, [], $code);
    }

    public function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'expires_in'   => Auth::guard('api')->factory()->getTTL() * 60,
        ])->setStatusCode(201);
    }

    public function addSearchKeywordsToCache($searchKeywords)
    {
        $expiresAt = Carbon::now()->addWeek();

        // 用户登录
        if ($this->user()) {
            // 用户关键词搜索缓存
            $userCachedSearchKeywords = Cache::get($this->user_search_keywords_cache_key . $this->user()->id, function () {
                return [];
            });

            if ( !in_array($searchKeywords, $userCachedSearchKeywords)) {
                // 入栈
                array_push($userCachedSearchKeywords, $searchKeywords);
                Cache::put($this->user_search_keywords_cache_key . $this->user()->id, $userCachedSearchKeywords, $expiresAt);
            }
        }

        // 关键词搜索权重缓存
        $cachedSearchKeywordsWeight = Cache::get($this->search_keywords_weight_cache_key, function () {
            return [];
        });

        // ['美妆' => 1,'裙子' => 5, '零食' => 3];
        if ( !array_key_exists($searchKeywords, $cachedSearchKeywordsWeight)) {
            // 第一次搜索, 权重为一
            $cachedSearchKeywordsWeight[$searchKeywords] = 1;
            Cache::put($this->search_keywords_weight_cache_key, $cachedSearchKeywordsWeight, $expiresAt);
        } else {
            // 搜索一次, 权重加一
            $cachedSearchKeywordsWeight[$searchKeywords] += 1;
            Cache::put($this->search_keywords_weight_cache_key, $cachedSearchKeywordsWeight, $expiresAt);
        }
    }

    public function getHistorySearchKeywords()
    {
        $historySearchKeywords = Cache::get($this->user_search_keywords_cache_key . $this->user()->id, function () {
            return [];
        });

        $result['data'] = [];
        if ($historySearchKeywords) {
            // 倒序排列
            $historySearchKeywords = array_reverse($historySearchKeywords, true);
            foreach (array_slice($historySearchKeywords, 0, 6) as $key => $value) {
                $res['keywords'] = $value;
                $result['data'][] = $res;
            }
        }

        return response()->json($result)->setStatusCode(200);
    }

    public function deleteHistorySearchKeywords()
    {
        Cache::forget($this->user_search_keywords_cache_key . $this->user()->id);

        return $this->response->noContent();
    }

    public function getHotSearchKeywords()
    {
        $hotSearchKeywords = Cache::get($this->search_keywords_weight_cache_key, function () {
            return [];
        });

        $hotSearchKeywordsSortByWeight = [];
        if ( !empty($hotSearchKeywords)) {
            $hotSearchKeywordsValues = array_values($hotSearchKeywords);
            $hotSearchKeywordsKeys = array_keys($hotSearchKeywords);
            arsort($hotSearchKeywordsValues);

            foreach ($hotSearchKeywordsValues as $key => $value) {
                if (in_array($value, $hotSearchKeywords)) {
                    $hotSearchKeywordsSortByWeight[] = $hotSearchKeywordsKeys[$key];
                }
            }
        }

        $result['data'] = [];
        if ($hotSearchKeywordsSortByWeight) {
            foreach (array_slice($hotSearchKeywordsSortByWeight, 0, 6) as $key => $value) {
                $res['keywords'] = $value;
                $result['data'][] = $res;
            }
        }

        return response()->json($result)->setStatusCode(200);
    }
}

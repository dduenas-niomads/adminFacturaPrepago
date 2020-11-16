<?php

namespace App\Http\Controllers\Company;

use Illuminate\Support\Facades\Http as HttpClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class ApiCompanyController extends Controller
{
    /**
     * Create a new api controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public static function getMyCompany() {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->get(env('API_BUSINESS_URL') . 'companies');
            if ($request->successful()) {
                $response = $request->json();
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function updateMyCompany($params = [])
    {
        $response = null;
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->patch(env('API_BUSINESS_URL') . 'companies', [
                'bs_ms_company_categories_id' => isset($params['inputCategoryId']) ? $params['inputCategoryId'] : null,
                'name' => isset($params['inputName']) ? $params['inputName'] : null,
                'description' => isset($params['inputDescription']) ? $params['inputDescription'] : null,
                'address' => isset($params['inputAddress']) ? $params['inputAddress'] : null,
                'district' => isset($params['inputDistrict']) ? $params['inputDistrict'] : null,
                'city' => isset($params['inputCity']) ? $params['inputCity'] : null,
                'country' => isset($params['inputCountry']) ? $params['inputCountry'] : null,
                'currency' => isset($params['inputCurrency']) ? $params['inputCurrency'] : null,
                'ecommerce_store' => isset($params['ecommerce_store']) ? $params['ecommerce_store'] : null,
                'ecommerce_api_key' => isset($params['ecommerce_api_key']) ? $params['ecommerce_api_key'] : null,
                'ecommerce_password' => isset($params['ecommerce_password']) ? $params['ecommerce_password'] : null,
                'ecommerce_shared_secret' => isset($params['ecommerce_shared_secret']) ? $params['ecommerce_shared_secret'] : null,
                'null_validation' => true
            ]);
            if ($request->successful()) {
                $response = $request->json();
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function getCompanyCategories(Type $var = null)
    {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->get(env('API_BUSINESS_URL') . 'companies/categories');
            if ($request->successful()) {
                $response = $request->json();
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function dateDiff($dateEnd)
    {
        $date = Carbon::parse($dateEnd);
        $now = Carbon::now();
        $diff = $date->diffInDays($now);
        return $diff;
    }
}

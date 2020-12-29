<?php

namespace App\Http\Controllers\Sale;

use Illuminate\Support\Facades\Http as HttpClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ApiSaleController extends Controller
{
    /**
     * Create a new api controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    private static function getOrderColumnName($order = 0) {
        $columnName = null;
        switch ($order) {
            case 0:
                $columnName = 'warehouse_name';
                break;
            case 1:
                $columnName = 'ticket';
                break;
            case 2:
                $columnName = 'customer_name';
                break;
            case 3:
                $columnName = 'total';
                break;
            case 4:
                $columnName = 'created_at';
                break;
            case 4:
                $columnName = 'status';
                break;
            default:
                $columnName = 'ticket';
                break;
        }
        return $columnName;
    }

    private static function getOrderEcommerceColumnName($order = 0) {
        $columnName = null;
        switch ($order) {
            case 0:
                $columnName = 'warehouse_name';
                break;
            case 1:
                $columnName = 'ticket';
                break;
            case 2:
                $columnName = 'customer_name';
                break;
            case 3:
                $columnName = 'total';
                break;
            case 4:
                $columnName = 'created_at';
                break;
            case 4:
                $columnName = 'status';
                break;
            default:
                $columnName = 'ticket';
                break;
        }
        return $columnName;
    }

    private static function optimizeOrder($order) {
        if (!is_null($order) && isset($order[0])) {
            $order = [
                "name" => self::getOrderColumnName($order[0]['column']),
                "dir" => $order[0]['dir'],
                "opt" => true
            ];
        }
        return $order;
    }

    private static function optimizeOrderEcommerce($order) {
        if (!is_null($order) && isset($order[0])) {
            $order = [
                "name" => self::getOrderColumnName($order[0]['column']),
                "dir" => $order[0]['dir'],
                "opt" => true
            ];
        }
        return $order;
    }

    public static function getEcommerceCredentials()
    {
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

    public static function getList(Request $request) {
        $response = ["data" => []];
        if (Auth::user()) {
            $params = $request->all();
            $params['order'] = self::optimizeOrder(isset($params['order']) ? $params['order'] : null);
            $response = self::getListParent($params, Auth::user()->role['code'] . '/sales');
            if (isset($response['body'])) {
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function getListEcommerce(Request $request) {
        $response = ["data" => []];
        if (Auth::user()) {
            $params = $request->all();
            $params['order'] = self::optimizeOrderEcommerce(isset($params['order']) ? $params['order'] : null);
            if (isset($params['report'])) {
                $response = self::getListParent($params, Auth::user()->role['code'] . '/orders-ecommerce', '&limit=0&period=' . $params['period'] . '&document=' . $params['document'] . '&orderNumber=' . $params['orderNumber']);
            } else {
                $response = self::getListParent($params, Auth::user()->role['code'] . '/orders-ecommerce');
                if (isset($response['body'])) {
                    $response = $response['body'];
                }
            }
        }
        return $response;
    }

    public static function salesEcommerceAccessToken(Request $request)
    {
        // Set variables for our request
        $shared_secret = "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";
        $params = $request->all(); // Retrieve all request parameters
        $hmac = $params['hmac']; // Retrieve HMAC request parameter
        $params = array_diff_key($params, array('hmac' => '')); // Remove hmac from params
        ksort($params); // Sort params lexographically

        // Compute SHA256 digest
        $computed_hmac = hash_hmac('sha256', http_build_query($params), $shared_secret);

        // Use hmac data to check that the response is from Shopify or not
        if (hash_equals($hmac, $computed_hmac)) {
            // VALIDATED
        } else {
            // NOT VALIDATED – Someone is trying to be shady!
        }
    }

    public static function getById($id) {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->get(env('API_BUSINESS_URL') . 'sales/' . $id);
            if ($request->successful()) {
                $response = $request->json();
                $response = $response['body'];
            }
        }
        return $response;
    }

    public static function update($id, $params = [])
    {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->patch(env('API_BUSINESS_URL') . Auth::user()->role['code'] . '/sales/' . $id, $params);
            if ($request->successful()) {
                $response = $request->json();
                $response['result'] = "success";
            } else {
                $response = $request->json();
                $response['result'] = "danger";
            }
        }
        return $response;
    }

    public static function create($params = [])
    {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->post(env('API_BUSINESS_URL') . Auth::user()->role['code'] . '/sales', $params);
            if ($request->successful()) {
                $response = $request->json();
                $response['result'] = "success";
            } else {
                $response = $request->json();
                $response['result'] = "danger";
            }
        }
        return $response;
    }

    public static function delete($id)
    {
        $response = [];
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->delete(env('API_BUSINESS_URL') . Auth::user()->role['code'] . '/sales/' . $id);
            if ($request->successful()) {
                $response = $request->json();
                $response['result'] = "success";
            } else {
                $response = $request->json();
                $response['result'] = "danger";
            }
        }
        return $response;
    }
}

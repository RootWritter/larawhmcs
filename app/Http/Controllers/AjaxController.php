<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DarthSoup\Whmcs\WhmcsManager;

class AjaxController extends Controller
{
    private WhmcsManager $whmcsManager;

    public function __construct(WhmcsManager $whmcsManager)
    {
        $this->whmcsManager = $whmcsManager;
    }
    public function getproductDetail(Request $request)
    {
        $detailProduct = $this->whmcsManager->orders()->getProducts([
            'pid' => (int)$request['id'],
        ]);
        $data = $detailProduct['products']['product'][0]['pricing']['USD'];
        $array = array();
        foreach ($data as $x => $val) {
            if (preg_match("/ly/i", $x)) {
                $array[$x] = $val;
            }
        }
        return response()->json([
            'prefix' => $data['prefix'],
            'suffix' => $data['suffix'],
            'pricing' => $array
        ]);
    }
    public function getDomainPricing()
    {
        $domain = $this->whmcsManager->domains()->getTldPricing();
        $data = $domain['pricing'];
        $array = array();
        foreach ($data as $x => $val) {
            $array[$x] = $data[$x]['register'][1];
        }
        return response()->json([
            'prefix' => $domain['currency']['prefix'],
            'suffix' => $domain['currency']['suffix'],
            'pricing' => $array
        ]);
    }
    public function login(Request $request)
    {
        try {
            $validate = $this->validate($request, [
                'email' => 'required',
                'password' => 'required'
            ]);
            $dPost = array(
                'action' => 'ValidateLogin',
                // See https://developers.whmcs.com/api/authentication
                'username' => env('WHMCS_API_IDENTIFIER'),
                'password' => env('WHMCS_API_SECRET'),
                'email' =>  $validate['email'],
                'password2' => $validate['password'],
                'responsetype' => 'json',
            );
            $curl = post_curl(env('WHMCS_API_URL') . '/includes/api.php', $dPost);
            if ($curl['result'] == "success") {
                return response()->json([
                    'status' => true,
                    'message' => 'Success Login',
                    'data' => array(
                        'id' => $curl['userid']
                    )
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Error Combination Email and Password'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function register(Request $request)
    {
        try {
            $validate = $this->validate($request, [
                'email' => 'required',
                'password' => 'required',
                'name' => 'required',
                'phone' => 'required',
            ]);
            $result = $this->whmcsManager->client()->addClient([
                'firstname' => $validate['name'],
                'lastname' => 'x',
                'email' => $validate['email'],
                'country' => 'ID',
                'password2' => $validate['password'],
                'phonenumber' => '+62.' . $validate['phone'],
                'address1' => 'x',
                'city' => 'x',
                'postcode' => '12345',
                'state' => 's',
                'clientip' => $request->ip(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Registration Success',
                'data' => array(
                    'id' => $result['clientid']
                )
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function order(Request $request)
    {
        try {
            $validate = $this->validate(
                $request,
                [
                    'user_id' => 'required',
                    'type_domain' => 'required|in:register_new,have_domain',
                    'packages_id' => 'required',
                    'period' => 'required',
                ],
                [
                    'user_id.required' => 'Please Login/Register First Before Transaction',
                    'type_domain.required', 'Please Select Register New Domain / I Have a Domain',
                    'packages_id.required' => 'Please Select a Packages',
                    'period.required' => 'Please Select a Period of services',
                ]
            );
            if ($validate['type_domain'] == "register_new") {
                if ($request['extension'] == null) {
                    throw new \ErrorException('Ektensi domain wajib di pilih');
                } else {
                    $domain = $request['domain'] . '.' . $request['extension'];
                }
            } else {
                if ($request['domain_new'] == null) {
                    throw new \ErrorException('Ektensi domain wajib di pilih');
                } else {
                    $domain = $request['domain_new'];
                }
            }
            $result = $this->whmcsManager->orders()->addOrder([
                'clientid' => (int)$validate['user_id'],
                'pid' => [
                    (int)$validate['packages_id']
                ],
                'domain' => [$domain],
                'domaintype' => [$validate['type_domain'] == "register_new" ? "register" : ""],
                'regperiod' => array(1),
                'paymentmethod' => 'duitku_indomaret'
            ]);
            if ($result['result'] == "success") {
                return response()->json([
                    'status' => true,
                    'message' => 'Success Order',
                    'data' => array(
                        'id' => $result['orderid'],
                        'url_invoice' => env('WHMCS_API_URL') . '/viewinvoice.php?id=' . $result['orderid']
                    )
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal melakukan order'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}

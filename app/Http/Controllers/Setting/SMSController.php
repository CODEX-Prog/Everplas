<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SMS;

class SMSController extends Controller
{
    /**
     * Get a CompanyInformation.
     *
     * @return SMS
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $sms = SMS::find($id);
            return json_encode(['status' => 'success', 'sms' => $sms]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Create a CompanyInformation.
     *
     * @return SMS
     */
    public function create(Request $request) {
        $apiUrl = $request->get('sms-api-url');
        $password = $request->get('sms-pass');
        $username = $request->get('sms-username');

        $sms = new SMS();
        $sms->api_url = $apiUrl;
        $sms->username = $username;
        $sms->password = $password;
        $sms->save();

        return redirect('/dashboard');
    }
}

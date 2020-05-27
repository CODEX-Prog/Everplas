<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Get a Group.
     *
     * @return PaymentMethod
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $paymentMethod = PaymentMethod::find($id);
            return json_encode(['status' => 'success', 'paymentMethod' => $paymentMethod]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Create a Group.
     *
     * @return PaymentMethod
     */
    public function create(Request $request) {
        $name = $request->get('name');
        $paymentMethod = new PaymentMethod();
        $paymentMethod->name = $name;
        try {
            $paymentMethod->save();
            return json_encode(['status' => 'success', 'paymentMethod' => $paymentMethod]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update a Group.
     *
     * @return string
     */
    public function update(Request $request) {
        $name = $request->get('name');
        $id = $request->get('id');
        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->name = $name;
        try {
            $paymentMethod->save();
            return json_encode(['status' => 'success']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete a Group.
     *
     * @return string
     */
    public function delete(Request $request) {
        $id = $request->get('id');

        $paymentMethod = PaymentMethod::find($id);
        try {
            $paymentMethod->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}

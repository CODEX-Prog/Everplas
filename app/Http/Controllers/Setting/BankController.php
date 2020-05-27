<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;

class BankController extends Controller
{
    /**
     * Get a Bank.
     *
     * @return Bank
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $bank = Bank::find($id);
            return json_encode(['status' => 'success', 'bank' => $bank]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Get a Bank.
     *
     * @return Bank
     */
    public function getBanksByName($name=null, Request $request) {
        if(isset($name)) {
            $banks = Bank::where('name', 'LIKE', '%'.$name.'%')->get();
            return json_encode(['status' => 'success', 'banks' =>$banks, 'name' => $name]);
        } else {
            $banks = Bank::all();
            return json_encode(['status' => 'success', 'banks' =>$banks]);
        }
    }

    /**
     * Create a Bank.
     *
     * @return Bank
     */
    public function create(Request $request) {
        $name = $request->get('name');
        $bank = new Bank();
        $bank->name = $name;
        try {
            $bank->save();
            return json_encode(['status' => 'success', 'bank' => $bank]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update a Bank.
     *
     * @return string
     */
    public function update(Request $request) {
        $name = $request->get('name');
        $id = $request->get('id');
        $bank = Bank::find($id);
        $bank->name = $name;
        try {
            $bank->save();
            return json_encode(['status' => 'success']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete a Department.
     *
     * @return string
     */
    public function delete(Request $request) {
        $id = $request->get('id');

        $bank = Bank::find($id);
        try {
            $bank->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}

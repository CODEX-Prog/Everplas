<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Prefix;

class PrefixController extends Controller
{
    /**
     * Get a CompanyInformation.
     *
     * @return Prefix
     */
    public function index(Request $request) {
        // $id = $request->get('id');
        // try {
        //     $prefix = Prefix::find($id);
        //     return json_encode(['status' => 'success', 'prefix' => $prefix]);
        // } catch (\Exception $e) {
        //     return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        // }
        // $prefix = Prefix::all()->first();
        $prefix = Prefix::find(1);
        dd($prefix);
         
        return view('setting.setting', compact('prefix'));
    }

    /**
     * Create a CompanyInformation.
     *
     * @return Prefix
     */
    public function create(Request $request) {
        $invoice = $request->get('invoice-pre');
        $estimation = $request->get('estimation-pre');
        $jobOrder = $request->get('joborder-pre');
        $credit = $request->get('credit-pre');
        $employee = $request->get('employee-pre');
        $bank = $request->get('bank-pre');
        $purchase = $request->get('purchase-pre');
        $quotation = $request->get('quotation-pre');
        $po = $request->get('po-pre');
        $receipt = $request->get('receipt-pre');
        $receiving = $request->get('receiving-pre');
        $accent = $request->get('accent-pre');
        $transaction = $request->get('transaction-pre');

        $prefix = new Prefix();
        $prefix->invoice = $invoice;
        $prefix->quotation = $quotation;
        $prefix->estimation = $estimation;
        $prefix->po = $po;
        $prefix->joborder = $jobOrder;
        $prefix->receipt = $receipt;
        $prefix->credit_note = $credit;
        $prefix->receiving = $receiving;
        $prefix->employee = $employee;
        $prefix->accenting = $accent;
        $prefix->bank = $bank;
        $prefix->transaction = $transaction;
        $prefix->purchase = $purchase;
        $prefix->save();

        return redirect('/dashboard');
    }

// Update Prefixes 
    public function update(Request $request, $id) {
    
        $data = request()->validate([
         'invoice-pre' => 'required',
         'estimation-pre' => 'required',
         'joborder-pre' => 'required',
         'credit-pre' => 'required',
         'employee-pre' => 'required',
         'bank-pre' => 'required',
         'purchase-pre' => 'required',
         'quotation-pre' => 'required',
         'po-pre' => 'required',
         'receipt-pre' => 'required',
         'receiving-pre' => 'required',
         'accent-pre' => 'required',
         'transaction-pre' => 'required',
       ]);
 
    //    dd($data);
 
         $pre =  Prefix::find($id);

         $invoice = $request->get('invoice-pre');
         $estimation = $request->get('estimation-pre');
         $joborder = $request->get('joborder-pre');
         $credit = $request->get('credit-pre');
         $employee = $request->get('employee-pre');
         $bank = $request->get('bank-pre');
         $purchase = $request->get('purchase-pre');
         $quotation = $request->get('quotation-pre');
         $po = $request->get('po-pre');
         $receipt = $request->get('receipt-pre');
         $receiving = $request->get('receiving-pre');
         $accent = $request->get('accent-pre');
         $transaction = $request->get('transaction-pre');

         $pre->invoice = $invoice;
         $pre->estimation = $estimation;
         $pre->joborder = $joborder;
         $pre->credit_note = $credit;
         $pre->employee = $employee;
         $pre->bank = $bank;
         $pre->purchase = $purchase;
         $pre->quotation = $quotation;
         $pre->po = $po;
         $pre->receipt = $receipt;
         $pre->receiving = $receiving;
         $pre->accenting = $accent;
         $pre->transaction = $transaction;
 
         $pre->save();
 
         return redirect('/dashboard');
     }
}

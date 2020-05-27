<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Sale;
use App\Models\LeadProduct;
use App\Models\AllOrder;
use App\Models\Company;
use App\Models\Prefix;

class SalesController extends Controller
{
    /**
     * Create new Lead
     * @param Request
     *
    */
    public function create(Request $request) {
        $lead = new Lead();
        $order = new AllOrder();
        $prefix = Prefix::find(1);
        // $sale = new Sale();

        $subject = $request->input('subject');
        $related = $request->input('related');
        $client = $request->input('client');
        if (substr($client, 0 ,3) === "com") {
            $companyId = (int)(substr($client, 3, 1));
        } else {
            $contactId = (int)(substr($client, 3, 1));
        }
        $date = $request->input('date');
        $tillDate = $request->input('open-till');
        $status = $request->input('status');
        $employeeId = $request->input('employee');
        $address = $request->input('address');
        $country = $request->input('country');
        $city = $request->input('city');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subTotal = $request->input('sub-total');
        $totalVat = $request->input('total-vat');
        $discount = $request->input('discount');
        $total = $request->input('total');
        $prodList = $request->input('prod-list');
        $IdentityButton = $request->input('IdentifyButton');
        $prodArr = json_decode($prodList);
       
        // dd($IdentityButton);
        // dd($request);

        //   dd($prodArr);


        if ($IdentityButton == 'SaveLead') {

            $lead->subject = $subject;
            isset($companyId) ? $lead->company_id = $companyId : $lead->contact_id = $contactId;
            $lead->date = $date;
            $lead->till_date = $tillDate;   
            // if ( $status == 'Draft' || $status == 'Sent' || $status == 'Revised' ) {
            //     $lead->status = $status;
               
            // } 
            // elseif ( $status == 'Open'  ) {
            //     $lead->status = $status;

            // } 
            // elseif ( $status == 'Declined'  ) {
            //     $lead->status = $status;
        
            // } 
            // else {  
            //     $lead->status = $status; 
            // }

            if ( $status == 'Accepted' && $related == 'Sales' ){

                $lead->status = "Open";
                $lead->related = "Lead";

            } elseif ( $status == 'Accepted' ) {

                $lead->status = "Open"; 
                $lead->related = $related;

            } else  {

                $lead->related = "Lead";
                $lead->status = $status; 

            }
        
            $lead->employee_id = $employeeId;
            $lead->address = $address;
            $lead->country = $country;
            $lead->city = $city;
            $lead->email = $email;
            $lead->phone = $phone;
            $lead->subtotal = $subTotal;
            $lead->total_vat = $totalVat;
            $lead->discount = $discount;
            $lead->total = $total;
        // $lead->created_by = Auth::user()->full_name;
        // $lead->updated_by = Auth::user()->full_name;
            $lead->created_at = NOW();
            $lead->updated_at = NOW();
            $lead->save();

            // Saving multiple products selected for lead
            foreach($prodArr as $prod) {

                $lead->products()->attach($prod->id,['prod_name' => $prod->name, 'description' => $prod->des, 'qty' =>$prod->qty, 'rate' => $prod->rate, 'vat' => $prod->vat, 'amount' => $prod->amount, 'created_at'=>NOW(), 'updated_at'=>NOW() ] );

            }


            // dd( $lead->id);
            $idFormat = $prefix->joborder. time() ."-" . job_id($lead->id);

            $order->L_id = $lead->id;
            $order->requested_by = $lead->employee->full_name;
            // if (substr($clientId, 0, 3) === "com") {
            // $companyId = (int)(substr($clientId, 3, 1));
            // $order->from = $lead->company->company_name;
            // } else {
            // $contactId = (int)(substr($clientId, 3, 1));
            // $order->from = $lead->contact->contact_name;
            // }
            isset($companyId) ? $order->from = $lead->company->company_name : $order->from  = $lead->contact->contact_name;
            $order->description = '';   
            $order->date = $date;
            $order->day_ago = ceil((time() - strtotime($date))/60/60/24);
            $order->related = "Sales";
            $order->Job_id = $idFormat;
            $order->status = "Not yet";
            $order->created_at = NOW();
            $order->updated_at = NOW();
    
            $order->save();



        } else {



            $lead->subject = $subject;
            isset($companyId) ? $lead->company_id = $companyId : $lead->contact_id = $contactId;
            $lead->date = $date;
            $lead->till_date = $tillDate;   


            $lead->status = "Accepted";
            $lead->related =  "Sales";

            $lead->employee_id = $employeeId;
            $lead->address = $address;
            $lead->country = $country;
            $lead->city = $city;
            $lead->email = $email;
            $lead->phone = $phone;
            $lead->subtotal = $subTotal;
            $lead->total_vat = $totalVat;
            $lead->discount = $discount;
            $lead->total = $total;
        // $lead->created_by = Auth::user()->full_name;
        // $lead->updated_by = Auth::user()->full_name;
            $lead->created_at = NOW();
            $lead->updated_at = NOW();
            $lead->save();

        // Saving multiple products selected for lead
            foreach($prodArr as $prod) {

                $lead->products()->attach($prod->id,['prod_name' => $prod->name, 'description' => $prod->des, 'qty' =>$prod->qty, 'rate' => $prod->rate, 'vat' => $prod->vat, 'amount' => $prod->amount, 'created_at'=>NOW(), 'updated_at'=>NOW() ] );

            }

            // dd($lead->id);

            // $order->L_id = $lead->id;
            // $order->save();

            // dd($lead->company->company_name);
            $idFormat = $prefix->joborder. time() ."-" . job_id($lead->id);

            $order->L_id = $lead->id;
            $order->requested_by = $lead->employee->full_name;
            // if (substr($clientId, 0, 3) === "com") {
            // $companyId = (int)(substr($clientId, 3, 1));
            // $order->from = $lead->company->company_name;
            // } else {
            // $contactId = (int)(substr($clientId, 3, 1));
            // $order->from = $lead->contact->contact_name;
            // }
            isset($companyId) ? $order->from = $lead->company->company_name : $order->from  = $lead->contact->contact_name;
            $order->description = '';   
            $order->date = $date;
            $order->day_ago = ceil((time() - strtotime($date))/60/60/24);
            $order->related = "Sales";
            $order->Job_id = $idFormat;
            $order->status = "Not yet";
            $order->created_at = NOW();
            $order->updated_at = NOW();
    
            $order->save();




        }


        return redirect('/sales');
    }



    public function edit($id) {
        $LeadDetails = Lead::find($id);
    return view('sales.lead-edit')->with(['LE' => $LeadDetails ]);
    }


// Update leads 
    public function update(Request $request, $id) {
        $lead = Lead::find($id);

//    dd($request);
        
        $subject = $request->get('subject');
        $related = $request->get('related');
        if ( $related == 'Sales' ) {
            $status = "Accepted";
        }
        else {
            $status = $request->get('status');
        }
        $client = $request->get('client');
       
        if (substr($client, 0 ,3) === "com") {
            $companyId = (int)(substr($client, 3, 1));
            $contactId = null;
        } else {
            $contactId = (int)(substr($client, 3, 1));
            $companyId = null;
        }
        $date = $request->get('date');
        $tillDate = $request->get('open-till');
       
        $employeeId = $request->get('employee');
        $address = $request->get('address');
        $country = $request->get('country');
        $city = $request->get('city');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $subTotal = $request->get('sub-total');
        $totalVat = $request->get('total-vat');
        $discount = $request->get('discount');
        $total = $request->get('total');
        $prodList = $request->get('prod-list');
        $IdentityButton = $request->get('IdentifyButton');
        $prodArr = json_decode($prodList);

        // dd($prodArr);
// dd(  $companyId);
        $lead->subject = $subject;
        // isset($companyId) ? $lead->company_id = $companyId : $lead->contact_id = $contactId;
        if(isset($companyId)) {
            $lead->company_id = $companyId;
            $lead->contact_id = $contactId;
        } else {
            $lead->contact_id = $contactId;
            $lead->company_id = $companyId;
        }
        $lead->date = $date;
        $lead->till_date = $tillDate;
        $lead->status = $status;
        $lead->related = $related;
        // $lead->employee_id = 2;
        $lead->address = $address;
        $lead->country = $country;
        $lead->city = $city;
        $lead->email = $email;
        $lead->phone = $phone;
        $lead->subtotal = $subTotal;
        $lead->total_vat = $totalVat;
        $lead->discount = $discount;
        $lead->total = $total;
    // $lead->created_by = Auth::user()->full_name;
    // $lead->updated_by = Auth::user()->full_name;
        $lead->created_at = NOW();
        $lead->updated_at = NOW();

        // dd($lead);
        $lead->save();



    // Saving updating multiple products selected for lead
    foreach($prodArr as $prod) {
        
        $lead->products()->updateExistingPivot($prod->id,['prod_name' => $prod->name, 'description' => $prod->des, 'qty' =>$prod->qty, 'rate' => $prod->rate, 'vat' => $prod->vat, 'amount' => $prod->amount, 'created_at'=>NOW(), 'updated_at'=>NOW() ] );
    

        }
        $addpassed = array();

        $addTable = array();
        // for ($x = 0; $x < count($prodArr); $x++) {
        //     // dd(count($prodArr));
        //     // dd($prodArr[$x+1]->id);
        //     array_push($add,  $lead->products()->where('product_id' , '=', $prodArr[$x]->id)->get());
           
          
        //     // dd($add);
        //   }
        //   dd($prodArr);
        //   dd($add[0][0]['id']);

        // dd($lead->products()->where('product_id' ,'>' ,0)->pluck('product_id')->toArray());   

        // $add= $lead->products()->where('product_id' ,'>' ,0)->pluck('product_id')->all();
      
          $addTable= $lead->products()->where('product_id' ,'>' ,0)->pluck('product_id')->all();
        //   dd($addTable);
        
        // dd($prodArr);
        for ($x = 0; $x < count($prodArr); $x++) {
       array_push( $addpassed,$prodArr[$x]->id);
        }
        $addpassed = array_map('intval', $addpassed);
        // dd($addpassed);

        // $addafter= $lead->products()->whereIn('product_id' , $add  )->pluck('product_id')->all();

        // dd($addafter);
       

        for ($x = 0; $x < count($prodArr); $x++) {
            if (in_array($addpassed[$x], $addTable )){

                // dd($addpassed[$x]) ;
            }
            else{
                // dd($addpassed[$x]) ;
                $lead->products()->attach($prodArr[$x]->id,['prod_name' => $prodArr[$x]->name, 'description' => $prodArr[$x]->des, 'qty' =>$prodArr[$x]->qty, 'rate' => $prodArr[$x]->rate, 'vat' => $prodArr[$x]->vat, 'amount' => $prodArr[$x]->amount, 'created_at'=>NOW(), 'updated_at'=>NOW() ] );  
            }
        }
    

        // foreach($prodArr as $prod) { 
         

         
        //     for ($x = 0; $x < count($add)-1; $x++) {
        //         // dd( $add[$x][$x]['id'] );
        //         if( $add[$x] != $prod->id ){
        //             $lead->products()->attach($prod->id,['prod_name' => $prod->name, 'description' => $prod->des, 'qty' =>$prod->qty, 'rate' => $prod->rate, 'vat' => $prod->vat, 'amount' => $prod->amount, 'created_at'=>NOW(), 'updated_at'=>NOW() ] );  
        //         }
        //     }
           
        //  }

        return redirect('/sales');
       
    }

    /**
     * Delete a Lead.
     *
     * @return string
     */
    public function deleteLeads(Request $request) {
        $id = $request->get('id');
        $lead = Lead::find($id);
        try {
            $lead->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }


        /**
         * Delete a sale.
         *
         * @return string
         */
        public function deleteSales(Request $request) {
            $id = $request->get('id');
            $sale = Lead::find($id);
            try {
                $sale->delete();
                return json_encode(['status' => 'success']);
            } catch(\Exception $e) {
                return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
            }
        }



    /**
     * Approve a Sale to Complete.
     *
     * @return string
     */
    public function approveLead(Request $request) {
        $id = $request->get('id');
        $LeadApr = Lead::find($id);
        $LeadApr->status = "Accepted";
        try {
            $LeadApr->save();
            return json_encode(['status' => 'success', 'jo' => $LeadApr]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'fail']);
        }
    }

    /**
     * Approve a Sale to Complete.
     *
     * @return string
     */
    public function approveSale(Request $request) {
        $id = $request->get('id');
        $SaleApr = Lead::find($id);
        $SaleApr->status = "PAID";
        try {
            $SaleApr->save();
            return json_encode(['status' => 'success', 'jo' => $SaleApr]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'fail']);
        }
    }



        /**
     * Get Companies by name.
     *
     * @return array of Company
     */
    public function getCompaniesByName($name=null, Request $request) {
        if(isset($name)) {
            $companies = Company::where('company_name', 'LIKE', '%'.$name.'%')->get();
            return json_encode(['status' => 'success', 'companies' =>$companies, 'name' => $name]);
        } else {
            $companies = Company::all();
            return json_encode(['status' => 'success', 'companies' =>$companies]);
        }
    }
}

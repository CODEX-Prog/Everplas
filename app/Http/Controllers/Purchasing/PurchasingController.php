<?php

namespace App\Http\Controllers\Purchasing;

use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Prefix;
use App\Models\PurchasingOrder;
use App\Models\AllOrder;

class PurchasingController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request);

        $PurOrder = new PurchasingOrder();
        $order = new AllOrder();
        $prefix = Prefix::find(1);

        $subject = $request->input('job-subject');
        $clientId = $request->input('client-id');
        $status = $request->input('status');
        $startDate = date('Y-m-d', strtotime($request->input('date')));
        $dueDate = date('Y-m-d', strtotime($request->input('due-date')));
        $amount = $request->input('amount');
        $employeeId = $request->input('employee-id');
        $important = $request->input('importance');
        $description = $request->input('description');
        $materialList = json_decode($request->input('material-list'));
    
        $PurOrder->subject = $subject;

        if (substr($clientId, 0, 3) === "com") {
            $companyId = (int)(substr($clientId, 3, 1));
            $PurOrder->company_id = $companyId;
        } else {
            $contactId = (int)(substr($clientId, 3, 1));
            $PurOrder->contact_id = $contactId;
        }
        
        $PurOrder->status = $status;
        $PurOrder->start_date = $startDate;
        $PurOrder->due_date = $dueDate;
        $PurOrder->amount = $amount;
        $PurOrder->employee_id = $employeeId;
        $PurOrder->importance = $important;
        $PurOrder->description = $description;
        $PurOrder->created_by = Auth::user()->full_name;
        $PurOrder->updated_by = Auth::user()->full_name;

        if($request->has('attachments')) {
            $i = 0;
            $documentPath = '';
            $attachments = $request->file('attachments');
            foreach ($attachments as $attachment) {
                $filename = Str::slug($request->input('job-subject')).'_'.'documents'.'_'.$i.'_'.time();
                $folder = '/uploads/purchasing/joborders/';
                $filePath = $folder . $filename. '.' . $attachment->getClientOriginalExtension();
                $documentPath = $documentPath.','.$filePath;
                $this->uploadOne($attachment, $folder, 'public', $filename);
                $i++;
            }
            $PurOrder->documents = $documentPath;
        }

        $PurOrder->save();

        foreach ($materialList->list as $list) {
            $PurOrder->materials()->attach($list->id,
                [
                    'description' => $list->description,
                    'quantity' =>$list->quantity,
                    'weight' => $list->weight,
                    'amount' => $list->amount,
                    'created_at'=>NOW(), 
                    'updated_at'=>NOW(),
                ]);
        }

        $idFormat = $prefix->joborder. time() ."-" . job_id($PurOrder->id);
       
        // dd($idFormat);
            // dd($PurOrder->contact);

            // Saving For All Orders
            $order->P_id = $PurOrder->id;
            $order->requested_by = $PurOrder->employee->full_name;
            if (substr($clientId, 0, 3) === "com") {
            $companyId = (int)(substr($clientId, 3, 1));
            $order->from = $PurOrder->company->company_name;
            } else {
            $contactId = (int)(substr($clientId, 3, 1));
            $order->from = $PurOrder->contact->contact_name;
            }
            $order->description = $description;   
            $order->date = $startDate;
            $order->day_ago = ceil((time() - strtotime($startDate))/60/60/24);
            $order->related = "Purchasing";
            $order->Job_id = $idFormat;
            $order->status = $status;

            $order->created_at = NOW();
            $order->updated_at = NOW();

            $order->save();



        return redirect('/purchasing');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        $id = $request->input('id');
        $PurOrder =PurchasingOrder::find($id);

        $subject = $request->input('job-subject');
        $clientId = $request->input('client-id');
        $status = $request->input('status');
        $startDate = date('Y-m-d', strtotime($request->input('date')));
        $dueDate = date('Y-m-d', strtotime($request->input('due-date')));
        $amount = $request->input('amount');
        $employeeId = $request->input('employee-id');
        $important = $request->input('importance');
        $description = $request->input('description');
        $materialList = json_decode($request->input('material-list'));

        $PurOrder->subject = $subject;

        if (substr($clientId, 0, 3) === "com") {
            $companyId = (int)(substr($clientId, 3, 1));
            $PurOrder->company_id = $companyId;
        } else {
            $contactId = (int)(substr($clientId, 3, 1));
            $PurOrder->contact_id = $contactId;
        }

        $PurOrder->status = $status;
        $PurOrder->start_date = $startDate;
        $PurOrder->due_date = $dueDate;
        $PurOrder->amount = $amount;
        $PurOrder->employee_id = $employeeId;
        $PurOrder->importance = $important;
        $PurOrder->description = $description;
        $PurOrder->updated_by = Auth::user()->full_name;

        if($request->has('attachments')) {
            $i = 0;
            $documentPath = '';
            $attachments = $request->file('attachments');
            foreach ($attachments as $attachment) {
                $filename = Str::slug($request->input('job-subject')).'_'.'documents'.'_'.$i.'_'.time();
                $folder = '/uploads/purchasing/joborders/';
                $filePath = $folder . $filename. '.' . $attachment->getClientOriginalExtension();
                $documentPath = $documentPath.','.$filePath;
                $this->uploadOne($attachment, $folder, 'public', $filename);
                $i++;
            }
            $PurOrder->documents = $documentPath;
        }

        $PurOrder->materials()->detach();
        $PurOrder->save();
        foreach ($materialList->list as $list) {
            $PurOrder->materials()->attach($list->id,
                [
                    'description' => $list->description,
                    'quantity' =>$list->quantity,
                    'weight' => $list->weight,
                    'amount' => $list->amount,
                    'created_at'=>NOW(), 
                    'updated_at'=>NOW() 
                ]);
        }
        return redirect('/purchasing');
    }


        /**
     * Approve a JobOrder.
     *
     * @return string
     */
    public function approve(Request $request) {
        $id = $request->get('id');
        $PurOrder = PurchasingOrder::find($id);
        $PurOrder->status = "In Process";
        try {
            $PurOrder->save();
            return json_encode(['status' => 'success', 'jo' => $PurOrder]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'fail']);
        }
    }

        /**
     * Complete a JobOrder.
     *
     * @return string
     */
    public function complete(Request $request) {
        $id = $request->get('id');
        $PurOrder = PurchasingOrder::find($id);
        $PurOrder->status = "Completed";
        try {
            $PurOrder->save();
            return json_encode(['status' => 'success', 'jo' => $PurOrder]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'fail']);
        }
    }

    /**
     * Delete a JobOrder.
     *
     * @return string
     */
    public function delete(Request $request) {
        $id = $request->get('id');
        $PurOrder = PurchasingOrder::find($id);
        $PurOrder->materials()->detach();
        try {
            $PurOrder->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}

<?php

namespace App\Http\Controllers\Receiving;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Prefix;
use App\Models\JobOrder;
use App\Models\AllOrder;

class JobOrderController extends Controller
{
    use UploadTrait;

    /**
     * Create a Group.
     *
     * @return JobOrder
     */
    public function create(Request $request) {
        $jobOrder = new JobOrder();
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

        $jobOrder->subject = $subject;

        if (substr($clientId, 0, 3) === "com") {
            $companyId = (int)(substr($clientId, 3, 1));
            $jobOrder->company_id = $companyId;
        } else {
            $contactId = (int)(substr($clientId, 3, 1));
            $jobOrder->contact_id = $contactId;
        }

        $jobOrder->status = $status;
        $jobOrder->start_date = $startDate;
        $jobOrder->due_date = $dueDate;
        $jobOrder->amount = $amount;
        $jobOrder->employee_id = $employeeId;
        $jobOrder->importance = $important;
        $jobOrder->description = $description;
        $jobOrder->created_by = Auth::user()->full_name;
        $jobOrder->updated_by = Auth::user()->full_name;

        if($request->has('attachments')) {
            $i = 0;
            $documentPath = '';
            $attachments = $request->file('attachments');
            foreach ($attachments as $attachment) {
                $filename = Str::slug($request->input('job-subject')).'_'.'documents'.'_'.$i.'_'.time();
                $folder = '/uploads/receiving/joborders/';
                $filePath = $folder . $filename. '.' . $attachment->getClientOriginalExtension();
                $documentPath = $documentPath.','.$filePath;
                $this->uploadOne($attachment, $folder, 'public', $filename);
                $i++;
            }
            $jobOrder->documents = $documentPath;
        }

        $jobOrder->save();

        foreach ($materialList->list as $list) {
            $jobOrder->materials()->attach($list->id,
                [
                    'description' => $list->description,
                    'quantity' =>$list->quantity,
                    'weight' => $list->weight,
                    'amount' => $list->amount,
                    'created_at'=>NOW(), 
                    'updated_at'=>NOW(),
                ]);
        }


                // dd($jobOrder->employee->full_name);
                $idFormat = $prefix->joborder. time() ."-" . job_id($jobOrder->id);

                $order->R_id = $jobOrder->id;
                $order->requested_by = $jobOrder->employee->full_name;
                if (substr($clientId, 0, 3) === "com") {
                $companyId = (int)(substr($clientId, 3, 1));
                $order->from = $jobOrder->company->company_name;
                } else {
                $contactId = (int)(substr($clientId, 3, 1));
                $order->from = $jobOrder->contact->contact_name;
                }
                $order->description = $description;   
                $order->date = $startDate;
                $order->day_ago = ceil((time() - strtotime($startDate))/60/60/24);
                $order->related = "Receiving";
                $order->Job_id = $idFormat;
                $order->status = $status;
                $order->created_at = NOW();
                $order->updated_at = NOW();
        
                $order->save();


        return redirect('/receiving');
    }

    /**
     * Create a Group.
     *
     * @return JobOrder
     */
    public function update(Request $request) {
        $id = $request->input('id');
        $jobOrder =JobOrder::find($id);

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

        $jobOrder->subject = $subject;

        if (substr($clientId, 0, 3) === "com") {
            $companyId = (int)(substr($clientId, 3, 1));
            $jobOrder->company_id = $companyId;
        } else {
            $contactId = (int)(substr($clientId, 3, 1));
            $jobOrder->contact_id = $contactId;
        }

        $jobOrder->status = $status;
        $jobOrder->start_date = $startDate;
        $jobOrder->due_date = $dueDate;
        $jobOrder->amount = $amount;
        $jobOrder->employee_id = $employeeId;
        $jobOrder->importance = $important;
        $jobOrder->description = $description;
        $jobOrder->updated_by = Auth::user()->full_name;

        if($request->has('attachments')) {
            $i = 0;
            $documentPath = '';
            $attachments = $request->file('attachments');
            foreach ($attachments as $attachment) {
                $filename = Str::slug($request->input('job-subject')).'_'.'documents'.'_'.$i.'_'.time();
                $folder = '/uploads/receiving/joborders/';
                $filePath = $folder . $filename. '.' . $attachment->getClientOriginalExtension();
                $documentPath = $documentPath.','.$filePath;
                $this->uploadOne($attachment, $folder, 'public', $filename);
                $i++;
            }
            $jobOrder->documents = $documentPath;
        }

        $jobOrder->materials()->detach();
        $jobOrder->save();
        foreach ($materialList->list as $list) {
            $jobOrder->materials()->attach($list->id,
                [
                    'description' => $list->description,
                    'quantity' =>$list->quantity,
                    'weight' => $list->weight,
                    'amount' => $list->amount,
                    'created_at'=>NOW(), 
                    'updated_at'=>NOW() 
                ]);
        }
        return redirect('/receiving');
    }

    /**
     * Delete a JobOrder.
     *
     * @return string
     */
    public function delete(Request $request) {
        $id = $request->get('id');
        $jobOrder = JobOrder::find($id);
        $jobOrder->materials()->detach();
        try {
            $jobOrder->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }

    /**
     * Approve a JobOrder.
     *
     * @return string
     */
    public function approve(Request $request) {
        $id = $request->get('id');
        $jobOrder = JobOrder::find($id);
        $jobOrder->status = "In Process";
        try {
            $jobOrder->save();
            return json_encode(['status' => 'success', 'jo' => $jobOrder]);
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
        $jobOrder = JobOrder::find($id);
        $jobOrder->status = "Completed";
        try {
            $jobOrder->save();
            return json_encode(['status' => 'success', 'jo' => $jobOrder]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'fail']);
        }
    }
}

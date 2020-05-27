<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Asset;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PHPUnit\Util\Json;
use App\Models\Prefix;

class AssetController extends Controller
{
    use UploadTrait;

    /**
     * Get a Employee.
     *
     * @return Asset
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $asset = Asset::find($id);
            return json_encode(['status' => 'success', 'asset' => $asset]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function getAssetsByName($name=null, Request $request) {
        if(isset($name)) {
            $assets = Asset::where('name', 'LIKE', '%'.$name.'%')->get();
            return json_encode(['status' => 'success', 'assets' =>$assets, 'name' => $name]);
        } else {
            $assets = Asset::all();
            return json_encode(['status' => 'success', 'assets' =>$assets]);
        }
    }

    /**
     * Create a Employee.
     *
     * @return Asset
     */
    public function create(Request $request) {
        $asset = new Asset();
        $prefix = Prefix::find(1)->accenting;
        $name = $request->input('name');
//        $description = $request->input('description');
        $description = 'This is Asset Description';
        $manufacturer = $request->input('manufacturer');
        $deliveryDate = date('Y-m-d', strtotime($request->input('delivery-date')));
        $cost = $request->input('cost');
        $classification = $request->input('classification');
        $vendorId = $request->input('vendor-id');
        if(substr($vendorId, 0, 3) === "com") {
            $companyId = (int)substr($vendorId, 3, 1);
        } else {
            $contactId = (int)substr($vendorId, 3, 1);
        }
        $location = $request->input('location');
        $type = $request->input('type');
        $employeeId = $request->input('owner');
        $serial = $request->input('serial');
        $warrantyDate = date('Y-m-d', strtotime($request->input('warranty-date')));
        $createdBy = Auth::user()->full_name;
        $updatedBy = Auth::user()->full_name;

        if($request->has('attachments')) {
            $i = 0;
            $attachmentsPath = '';
            $attachments = $request->file('attachments');
            foreach ($attachments as $attachment) {
                $filename = Str::slug($request->input('name')).'_'.'attachments'.'_'.$i.'_'.time();
                $folder = '/uploads/inventory/attachments/';
                $filePath = $folder . $filename. '.' . $attachment->getClientOriginalExtension();
                $attachmentsPath = $attachmentsPath.','.$filePath;
                $this->uploadOne($attachment, $folder, 'public', $filename);
                $i++;
            }
            $asset->attachments = $attachmentsPath;
        }

        $asset->prefix = $prefix;
        $asset->name = $name;
        $asset->description = $description;
        $asset->manufacturer = $manufacturer;
        $asset->delivery_date = $deliveryDate;
        $asset->cost = $cost;
        $asset->classification = $classification;
        if (isset($companyId)) {
            $asset->company_id = $companyId;
        } else {
            $asset->contact_id = $contactId;
        }
        $asset->location = $location;
        $asset->type = $type;
        $asset->employee_id = $employeeId;
        $asset->serial = $serial;
        $asset->warranty_date = $warrantyDate;
        $asset->created_by = $createdBy;
        $asset->updated_by = $updatedBy;

        $asset->save();
        return redirect('/inventory/asset');
    }

    /**
     * Update a Employee.
     *
     * @return Asset
     */
    public function update(Request $request) {

        $id = $request->input('id');
        $name = $request->input('name');
//        $description = $request->input('description');
        $description = 'This is Asset Description';
        $manufacturer = $request->input('manufacturer');
        $deliveryDate = date('Y-m-d', strtotime($request->input('delivery-date')));
        $cost = $request->input('cost');
        $classification = $request->input('classification');
        $companyId = $request->input('company-id');
        $contactId = $request->input('contact-id');
        $location = $request->input('location');
        $type = $request->input('type');
        $employeeId = $request->input('owner');
        $serial = $request->input('serial');
        $warrantyDate = date('Y-m-d', strtotime($request->input('warranty-date')));
        $updatedBy = Auth::user()->full_name;

        $asset = Asset::find($id);
        if($request->has('attachments')) {
            $i = 0;
            $attachmentsPath = '';
            $attachments = $request->file('attachments');
            foreach ($attachments as $attachment) {
                $filename = Str::slug($request->input('name')).'_'.'attachments'.'_'.$i.'_'.time();
                $folder = '/uploads/inventory/attachments/';
                $filePath = $folder . $filename. '.' . $attachment->getClientOriginalExtension();
                $attachmentsPath = $attachmentsPath.','.$filePath;
                $this->uploadOne($attachment, $folder, 'public', $filename);
                $i++;
            }
            $asset->attachments = $attachmentsPath;
        }

        $asset->name = $name;
        $asset->description = $description;
        $asset->manufacturer = $manufacturer;
        $asset->delivery_date = $deliveryDate;
        $asset->cost = $cost;
        $asset->classification = $classification;
        $asset->company_id = $companyId;
        $asset->contact_id = $contactId;
        $asset->location = $location;
        $asset->type = $type;
        $asset->employee_id = $employeeId;
        $asset->serial = $serial;
        $asset->warranty_date = $warrantyDate;
        $asset->updated_by = $updatedBy;
        $asset->save();

        return redirect('/inventory/asset');
    }

    /**
     * Delete a Employee.
     *
     * @return Json
     */
    public function delete(Request $request) {
        $id = $request->get('id');
        $asset = Asset::find($id);
        try {
            $asset->delete();
            return json_encode(['status' => 'success']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'fail']);
        }
    }
}

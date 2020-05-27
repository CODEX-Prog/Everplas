<?php

namespace App\Http\Controllers\Inventory;

use App\Traits\UploadTrait;
use DemeterChain\Main;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Maintenance;
use PHPUnit\Util\Json;

class MaintenanceController extends Controller
{
    use UploadTrait;

    /**
     * Get a Maintenance.
     *
     * @return Maintenance
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $maintenance = Maintenance::find($id);
            return json_encode(['status' => 'success', 'maintenace' => $maintenance]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Create a Maintenance.
     *
     * @return Maintenance
     */
    public function create(Request $request) {
        $maintenance = new Maintenance();
        $assetId = $request->input('asset-id');
        $companyId = $request->input('company-id');
        $startDate = date('Y-m-d', strtotime($request->input('start-date')));
        $endDate = date('Y-m-d', strtotime($request->input('end-date')));
        $description = $request->input('description');
        $maintenEmployeeId = $request->input('mainten-employee-id');
        $superEmployeeId = $request->input('super-employee-id');
        $reviewEmployeeId = $request->input('review-employee-id');
        $reviewDate = date('Y-m-d', strtotime($request->input('review-date')));
        $closeDate = date('Y-m-d', strtotime($request->input('close-date')));
        $createdBy = Auth::user()->full_name;
        $updatedBy = Auth::user()->full_name;

        if($request->has('reports')) {
            $i = 0;
            $reportsPath = '';
            $reports = $request->file('reports');
            foreach ($reports as $report) {
                $filename = 'reports'.'_'.$i.'_'.time();
                $folder = '/uploads/inventory/maintenance/';
                $filePath = $folder . $filename. '.' . $report->getClientOriginalExtension();
                $reportsPath = $reportsPath.','.$filePath;
                $this->uploadOne($report, $folder, 'public', $filename);
                $i++;
            }
            $maintenance->reports = $reportsPath;
        }

        $maintenance->asset_id = $assetId;
        $maintenance->company_id = $companyId;
        $maintenance->start_date = $startDate;
        $maintenance->description = $description;
        $maintenance->mainten_employee_id = $maintenEmployeeId;
        $maintenance->super_employee_id = $superEmployeeId;
        $maintenance->review_employee_id = $reviewEmployeeId;
        $maintenance->end_date = $endDate;
        $maintenance->review_date = $reviewDate;
        $maintenance->close_date = $closeDate;
        $maintenance->created_by = $createdBy;
        $maintenance->updated_by = $updatedBy;

        $maintenance->save();
        return redirect('/inventory/maintenance');
    }

    /**
     * Update a Maintenance.
     *
     * @return Maintenance
     */
    public function update(Request $request) {
        $id = $request->input('id');
        $assetId = $request->input('asset-id');
        $companyId = $request->input('company-id');
        $startDate = date('Y-m-d', strtotime($request->input('start-date')));
        $endDate = date('Y-m-d', strtotime($request->input('end-date')));
        $description = $request->input('description');
        $maintenEmployeeId = $request->input('mainten-employee-id');
        $superEmployeeId = $request->input('super-employee-id');
        $reviewEmployeeId = $request->input('review-employee-id');
        $reviewDate = date('Y-m-d', strtotime($request->input('review-date')));
        $closeDate = date('Y-m-d', strtotime($request->input('close-date')));
        $createdBy = Auth::user()->full_name;
        $updatedBy = Auth::user()->full_name;

        $maintenance = Maintenance::find($id);

        if($request->has('reports')) {
            $i = 0;
            $reportsPath = '';
            $reports = $request->file('reports');
            foreach ($reports as $report) {
                $filename = 'reports'.'_'.$i.'_'.time();
                $folder = '/uploads/inventory/maintenance/';
                $filePath = $folder . $filename. '.' . $report->getClientOriginalExtension();
                $reportsPath = $reportsPath.','.$filePath;
                $this->uploadOne($report, $folder, 'public', $filename);
                $i++;
            }
            $maintenance->reports = $reportsPath;
        }

        $maintenance->asset_id = $assetId;
        $maintenance->company_id = $companyId;
        $maintenance->start_date = $startDate;
        $maintenance->description = $description;
        $maintenance->mainten_employee_id = $maintenEmployeeId;
        $maintenance->super_employee_id = $superEmployeeId;
        $maintenance->review_employee_id = $reviewEmployeeId;
        $maintenance->end_date = $endDate;
        $maintenance->review_date = $reviewDate;
        $maintenance->close_date = $closeDate;
        $maintenance->created_by = $createdBy;
        $maintenance->updated_by = $updatedBy;

        $maintenance->save();
        return redirect('/inventory/maintenance');
    }

    /**
     * Delete a Maintenance.
     *
     * @return Json
     */
    public function delete(Request $request) {
        $id = $request->get('id');
        $maintenance = Maintenance::find($id);
        try {
            $maintenance->delete();
            return json_encode(['status' => 'success']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'fail']);
        }
    }
}

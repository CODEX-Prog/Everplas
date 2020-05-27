<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use mysql_xdevapi\Exception;
use Psy\Util\Json;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;


class EmployeeController extends Controller
{

    use UploadTrait;

    /**
     * Get a Employee.
     *
     * @return Employee
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $employee = Employee::find($id);
            return json_encode(['status' => 'success', 'employee' => $employee]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Get Employees by name.
     *
     * @return array of  Employee
     */
    public function getEmployeesByName($name=null, Request $request) {
        if(isset($name)) {
            $employees = Employee::where('full_name', 'LIKE', '%'.$name.'%')->get();
            return json_encode(['status' => 'success', 'employees' => $employees, 'name' => $name]);
        } else {
            $employees = Employee::all();
            return json_encode(['status' => 'success', 'employees' => $employees]);
        }
    }

    /**
     * Create a Employee.
     *
     * @return Employee
     */
    public function create(Request $request) {
        $employee = new Employee();

        request()->validate([
            'personal-photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'doc-copies.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx,zip|max:2048',
        ]);

        $employee->full_name = $request->input('full-name');
        $employee->email = $request->input('email');
        $employee->birthday = $request->input('birthday');
        $employee->marital = $request->input('marital');
        $employee->phone = $request->input('phone');
        $employee->gender = $request->input('gender');
        $employee->nationality = $request->input('nationality');
        $employee->address = $request->input('address');
        $employee->cpr_number = $request->input('cpr-number');
        $employee->cpr_exp = date('Y-m-d', strtotime($request->input('cpr-exp-date')));
        $employee->passport_number = $request->input('marital');
        $employee->passport_exp = date('Y-m-d', strtotime($request->input('passport-exp-date')));
        $employee->working_as = $request->input('working-as');
        $employee->department_id = $request->input('department-id');
        $employee->destination = $request->input('destination');
        $employee->join_date = date('Y-m-d', strtotime($request->input('join-date')));
        $employee->end_date = date('Y-m-d', strtotime($request->input('end-date')));
        $employee->leaves_day = $request->input('leaves-day');
        $employee->salary_transfer_type = $request->input('salary-transfer-type');
        $employee->basic_salary = $request->input('basic-salary');
        $employee->employee_cosi = $request->input('employee-cosi');
        $employee->company_cosi = $request->input('company-cosi');
        $employee->lmra_monthly_fee = $request->input('lmra-monthly-fee');
        $employee->lmra_visa_fee = $request->input('lmra-visa-fee');
        $employee->visa_exp_date = date('Y-m-d', strtotime($request->input('visa-exp-date')));
        $employee->bank_id = $request->input('bank-id');
        $employee->iban = $request->input('iban');
        $employee->short_name = $request->input('marital');
        $employee->driving_license = $request->input('driving-license');
        $employee->blood_type = $request->input('blood-type');
        $employee->emerg_contact_name = $request->input('emerg-contact-name');
        $employee->emerg_contact_number = $request->input('emerg-contact-number');
        $employee->emerg_contact_relation = $request->input('emg-contact-relation');
        $employee->commotion_type = $request->input('commotion-type');

        if($request->has('personal-photo')) {
            $personalPhoto = $request->file('personal-photo');
            $name = Str::slug($request->input('full-name')).'_'.'personal'.'_'.time();
            $folder = '/uploads/hrm/personal/';
            $filePath = $folder . $name. '.' . $personalPhoto->getClientOriginalExtension();
            $employee->personal_photo = $filePath;
            $this->uploadOne($personalPhoto, $folder, 'public', $name);
        }

        if($request->has('doc-copies')) {
            $i = 0;
            $docCopiesPath = '';
            $docCopies = $request->file('doc-copies');
            foreach ($docCopies as $docCopy) {
                $name = Str::slug($request->input('full-name')).'_'.'doc_copy'.'_'.$i.'_'.time();
                $folder = '/uploads/hrm/doc-copies/';
                $filePath = $folder . $name. '.' . $docCopy->getClientOriginalExtension();
                $docCopiesPath = $docCopiesPath.','.$filePath;
                $this->uploadOne($docCopy, $folder, 'public', $name);
                $i++;
            }
            $employee->doc_copies = $docCopiesPath;
        }

        $employee->save();

        return redirect()->route('human.list');
    }

    /**
     * Update a Employee.
     *
     * @return Employee
     */
    public function update(Request $request) {
        $id = $request->input('employee-id');
        $employee = Employee::find($id);

        request()->validate([
            'personal-photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'doc-copies.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx,zip|max:2048',
        ]);

        $employee->full_name = $request->input('full-name');
        $employee->email = $request->input('email');
        $employee->birthday = $request->input('birthday');
        $employee->marital = $request->input('marital');
        $employee->phone = $request->input('phone');
        $employee->gender = $request->input('gender');
        $employee->nationality = $request->input('nationality');
        $employee->address = $request->input('address');
        $employee->cpr_number = $request->input('cpr-number');
        $employee->cpr_exp = date('Y-m-d', strtotime($request->input('cpr-exp-date')));
        $employee->passport_number = $request->input('marital');
        $employee->passport_exp = date('Y-m-d', strtotime($request->input('passport-exp-date')));
        $employee->working_as = $request->input('working-as');
        $employee->department_id = $request->input('department-id');
        $employee->destination = $request->input('destination');
        $employee->join_date = date('Y-m-d', strtotime($request->input('join-date')));
        $employee->end_date = date('Y-m-d', strtotime($request->input('end-date')));
        $employee->leaves_day = $request->input('leaves-day');
        $employee->salary_transfer_type = $request->input('salary-transfer-type');
        $employee->basic_salary = $request->input('basic-salary');
        $employee->employee_cosi = $request->input('employee-cosi');
        $employee->company_cosi = $request->input('company-cosi');
        $employee->lmra_monthly_fee = $request->input('lmra-monthly-fee');
        $employee->lmra_visa_fee = $request->input('lmra-visa-fee');
        $employee->visa_exp_date = date('Y-m-d', strtotime($request->input('visa-exp-date')));
        $employee->bank_id = $request->input('bank-id');
        $employee->iban = $request->input('iban');
        $employee->short_name = $request->input('marital');
        $employee->driving_license = $request->input('driving-license');
        $employee->blood_type = $request->input('blood-type');
        $employee->emerg_contact_name = $request->input('emerg-contact-name');
        $employee->emerg_contact_number = $request->input('emerg-contact-number');
        $employee->emerg_contact_relation = $request->input('emg-contact-relation');
        $employee->commotion_type = $request->input('commotion-type');

        if($request->has('personal-photo')) {
            $personalPhoto = $request->file('personal-photo');
            $name = Str::slug($request->input('full-name')).'_'.'personal'.'_'.time();
            $folder = '/uploads/hrm/personal/';
            $filePath = $folder . $name. '.' . $personalPhoto->getClientOriginalExtension();
            $employee->personal_photo = $filePath;
            $this->uploadOne($personalPhoto, $folder, 'public', $name);
        }

        if($request->has('doc-copies')) {
            $i = 0;
            $docCopiesPath = '';
            $docCopies = $request->file('doc-copies');
            foreach ($docCopies as $docCopy) {
                $name = Str::slug($request->input('full-name')).'_'.'doc_copy'.'_'.$i.'_'.time();
                $folder = '/uploads/hrm/doc-copies/';
                $filePath = $folder . $name. '.' . $docCopy->getClientOriginalExtension();
                $docCopiesPath = $docCopiesPath.','.$filePath;
                $this->uploadOne($docCopy, $folder, 'public', $name);
                $i++;
            }
            $employee->doc_copies = $docCopiesPath;
        }

        $employee->save();

        return redirect()->route('human.list');
    }

    /**
     * Delete a Employee.
     *
     * @return Json
     */
    public function delete(Request $request) {
        $id = $request->get('id');
        $employee = Employee::find($id);

        try {
            $employee->delete();
            return json_encode(['status' => 'success']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }



    public function downloadImage($imageId){
        $emp_photo = Employee::where('id', $imageId)->firstOrFail();
        $path = public_path(). $emp_photo->personal_photo;
        return response()->download($path, $emp_photo
                 ->original_filename, ['Content-Type' => $emp_photo->mime]);
     }


     public function download($id){
        $emp_doc = Employee::where('id', $id)->firstOrFail();
        $attaches_doc = explode(",", $emp_doc->doc_copies);
        $sol = substr($emp_doc->doc_copies, 1);
        //  dd($sol);
        $path = public_path(). $sol;
        return response()->download($path, $emp_doc
                 ->original_filename, ['Content-Type' => $emp_doc->mime]);
     }

    
}

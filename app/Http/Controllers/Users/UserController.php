<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use mysql_xdevapi\Exception;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Json;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;


class UserController extends Controller
{
    use UploadTrait;
    /**
     * Get a User.
     *
     * @return User
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $user = User::find($id);
            return json_encode(['status' => 'success', 'user' => $user]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Create a User.
     *
     * @return User
     */
    public function create(Request $request) {

      
        $userName = $request->get('userName');
        $password = $request->get('password');
        $email = $request->get('email');
        $fullName = $request->get('fullname');
        $emp_id = $request->get('empid');
        $gr_id = $request->get('grid');
        $userViewPermission = $request->get('userViewPermission');
        $userDeletePermission = $request->get('userDeletePermission');
        $userUpdatePermission = $request->get('userUpdatePermission');
        $userCreatePermission = $request->get('userCreatePermission');
        $crmViewPermission = $request->get('crmViewPermission');
        $crmDeletePermission = $request->get('crmDeletePermission');
        $crmUpdatePermission = $request->get('crmUpdatePermission');
        $crmCreatePermission = $request->get('crmCreatePermission');

        $employee = new Employee();


        $employee->full_name = $request->get('fullname');
        $employee->email = $request->get('email');
        $employee->birthday = $request->get('dob');
        $employee->marital = $request->get('marital');
        $employee->phone = $request->get('phone');
        $employee->gender = $request->get('gender');
        $employee->nationality = $request->get('nationality');
        $employee->address = $request->get('address');
        $employee->cpr_number = $request->get('cprno');
        $employee->cpr_exp = date('Y-m-d', strtotime($request->get('cprExp')));
        $employee->passport_number = $request->get('passno');
        $employee->passport_exp = date('Y-m-d', strtotime($request->get('passExp')));
        $employee->working_as = $request->get('workingAs');
        $employee->department_id = $request->get('department');
        $employee->destination = $request->get('designation');
        $employee->join_date = date('Y-m-d', strtotime($request->get('joiningDate')));
        $employee->end_date = date('Y-m-d', strtotime($request->get('endDate')));
        $employee->leaves_day = $request->get('leaveDays');
        $employee->salary_transfer_type = $request->get('SalaryTransferType');
        $employee->basic_salary = $request->get('basicSalary');
        $employee->employee_cosi = $request->get('empCosi');
        $employee->company_cosi = $request->get('companyCosi');
        $employee->lmra_monthly_fee = $request->get('lmraFee');
        $employee->lmra_visa_fee = $request->get('lmraVisaFee');
        $employee->visa_exp_date = date('Y-m-d', strtotime($request->get('passExp')));
        $employee->bank_id = $request->get('Bank');
        $employee->iban = $request->get('iban');
        $employee->short_name = $request->get('marital');
        $employee->driving_license = $request->get('DrivingLicence');
        $employee->blood_type = $request->get('bloodType');
        $employee->emerg_contact_name = $request->get('emrgContact');
        $employee->emerg_contact_number = $request->get('emrgContactNum');
        $employee->emerg_contact_relation = $request->get('emrgContactRel');
        $employee->commotion_type = $request->get('ComotionsT');



        if($request->hasFile('file')) {
            
            $personalPhoto = $request->file('file');
            $name = Str::slug($request->input('fullname')).'_'.'personal'.'_'.time();
            $folder = '/uploads/hrm/personal/';
            $filePath = $folder . $name. '.' . $personalPhoto->getClientOriginalExtension();
            $employee->personal_photo = $filePath;
            $this->uploadOne($personalPhoto, $folder, 'public', $name);
        }

        if($request->hasFile('files')) {
            $i = 0;
            $docCopiesPath = '';
            $docCopies = $request->file('files');
            foreach ($docCopies as $docCopy) {
                $name = Str::slug($request->input('fullname')).'_'.'doc_copy'.'_'.$i.'_'.time();
                $folder = '/uploads/hrm/doc-copies/';
                $filePath = $folder . $name. '.' . $docCopy->getClientOriginalExtension();
                $docCopiesPath = $docCopiesPath.','.$filePath;
                $this->uploadOne($docCopy, $folder, 'public', $name);
                $i++;
            }
            $employee->doc_copies = $docCopiesPath;
        }

        $employee->save();

        $emp_id = $employee->id;

        $user = new User();
        $user->name = $userName;
        $user->password = Hash::make($password);
        $user->email = $email;  
        $user->full_name = $fullName;
        $user->emp_id = $emp_id;
        $user->grp_id = $gr_id;
        $user->user_view_permission = $userViewPermission;
        $user->user_delete_permission = $userDeletePermission;
        $user->user_update_permission = $userUpdatePermission;
        $user->user_create_permission = $userCreatePermission;
        $user->crm_view_permission = $crmViewPermission;
        $user->crm_delete_permission = $crmDeletePermission;
        $user->crm_update_permission = $crmUpdatePermission;
        $user->crm_create_permission = $crmCreatePermission;

        try {
            $user->save();
            return json_encode(['status' => 'success', 'user' => $user]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }

    }

    /**
     * Update a User.
     *
     * @return string
     */
    public function update(Request $request) {
        $id = $request->get('id');
        $name = $request->get('name');
        $fullName = $request->get('fullName');
        $email = $request->get('email');

        $user = User::find($id);
        try {
            $user->name = $name;
            $user->full_name = $fullName;
            $user->email = $email;
            $user->save();

            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete a User.
     *
     * @return string
     */
    public function delete(Request $request) {
        $id = $request->get('id');
        $user = User::find($id);
        try {
            $user->delete();
            return json_encode(['status' => 'success']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }

    }
}

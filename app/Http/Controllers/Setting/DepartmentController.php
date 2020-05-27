<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Get a Department.
     *
     * @return Department
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $department = Department::find($id);
            return json_encode(['status' => 'success', 'department' => $department]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Get a Bank.
     *
     * @return Department
     */
    public function getDepartmentsByName($name=null, Request $request) {
        if(isset($name)) {
            $departments = Department::where('name', 'LIKE', '%'.$name.'%')->get();
            return json_encode(['status' => 'success', 'departments' =>$departments, 'name' => $name]);
        } else {
            $departments = Department::all();
            return json_encode(['status' => 'success', 'departments' =>$departments]);
        }
    }

    /**
     * Create a Department.
     *
     * @return Department
     */
    public function create(Request $request) {
        $name = $request->get('name');
        $department = new Department();
        $department->name = $name;
        try {
            $department->save();
            return json_encode(['status' => 'success', 'department' => $department]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update a Department.
     *
     * @return string
     */
    public function update(Request $request) {
        $name = $request->get('name');
        $id = $request->get('id');
        $department = Department::find($id);
        $department->name = $name;
        try {
            $department->save();
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

        $productCategory = Department::find($id);
        try {
            $productCategory->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}

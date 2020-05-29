<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
        $name = $request->get('userName');
        $password = $request->get('password');
        $email = $request->get('email');
        $fullName = $request->get('fullName');
        $userViewPermission = $request->get('userViewPermission');
        $userDeletePermission = $request->get('userDeletePermission');
        $userUpdatePermission = $request->get('userUpdatePermission');
        $userCreatePermission = $request->get('userCreatePermission');
        $crmViewPermission = $request->get('crmViewPermission');
        $crmDeletePermission = $request->get('crmDeletePermission');
        $crmUpdatePermission = $request->get('crmUpdatePermission');
        $crmCreatePermission = $request->get('crmCreatePermission');

        $user = new User();
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->full_name = $fullName;
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

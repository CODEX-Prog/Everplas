<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserGroup;

class GroupController extends Controller
{
    /**
     * Get a Group.
     *
     * @return UserGroup
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $group = UserGroup::find($id);
            return json_encode(['status' => 'success', 'group' => $group]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Get a UserGroup.
     *
     * @return UserGroup
     */
    public function getGroupsByName($name=null, Request $request) {
        if(isset($name)) {
            $groups = UserGroup::where('group_name', 'LIKE', '%'.$name.'%')->get();
            return json_encode(['status' => 'success', 'groups' =>$groups, 'name' => $name]);
        } else {
            $groups = UserGroup::all();
            return json_encode(['status' => 'success', 'groups' =>$groups]);
        }
    }

    /**
     * Create a UserGroup.
     *
     * @return UserGroup
     */
    public function create(Request $request) {
        $groupName = $request->get('groupName');
        $group = new UserGroup();
        $group->group_name = $groupName;

        try {
            $group->save();
            return json_encode(['status' => 'success', 'group' => $group]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update a UserGroup.
     *
     * @return string
     */
    public function update(Request $request) {
        $id = $request->get('id');
        $group_name = $request->get('group_name');

        $group = UserGroup::find($id);
        try {
            $group->group_name = $group_name;
            $group->save();
            return json_encode(['status' => 'success']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete a UserGroup.
     *
     * @return string
     */
    public function delete(Request $request) {
        $id = $request->get('id');

        $group = UserGroup::find($id);
        try {
            $group->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}

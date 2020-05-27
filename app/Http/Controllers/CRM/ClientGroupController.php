<?php

namespace App\Http\Controllers\Crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClientGroup;
use Illuminate\Support\Facades\Auth;

class ClientGroupController extends Controller
{
    /**
     * Get a Group.
     *
     * @return ClientGroup
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $group = ClientGroup::find($id);
            return json_encode(['status' => 'success', 'group' => $group]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Get a ClientGroup.
     *
     * @return ClientGroup
     */
    public function getGroupsByName($name=null, Request $request) {
        if(isset($name)) {
            $groups = ClientGroup::where('name', 'LIKE', '%'.$name.'%')->get();
            return json_encode(['status' => 'success', 'groups' =>$groups, 'name' => $name]);
        } else {
            $groups = ClientGroup::all();
            return json_encode(['status' => 'success', 'groups' =>$groups]);
        }
    }

    /**
     * Create a Group.
     *
     * @return ClientGroup
     */
    public function create(Request $request) {
        $groupName = $request->get('name');
        $group = new ClientGroup();
        $group->name = $groupName;
        $group->created_by = Auth::user()->full_name;
        $group->updated_by = Auth::user()->full_name;
        try {
            $group->save();
            return json_encode(['status' => 'success', 'group' => $group]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update a Group.
     *
     * @return string
     */
    public function update(Request $request) {
        $id = $request->get('id');
        $name = $request->get('name');
        $group = ClientGroup::find($id);
        try {
            $group->name = $name;
            $group->updated_by = Auth::user()->full_name;
            $group->save();
            return json_encode(['status' => 'success']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete a Group.
     *
     * @return string
     */
    public function delete(Request $request) {
        $id = $request->get('id');

        $group = ClientGroup::find($id);
        try {
            $group->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}

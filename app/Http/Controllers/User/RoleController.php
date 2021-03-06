<?php 

namespace App\Http\Controllers\User; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreRoleRequest;  
use App\Http\Requests\User\UpdateRoleRequest;  
use App\Models\Role; 
use App\Models\PermissionGroup; 
use App\Models\Permission;
use App\Models\Config;

class RoleController extends Controller 
{ 
    public function index()
    { 
        $this->authorize('settings-roles', Role::class);

        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $roles = Role::where('company_id', $_COOKIE["company_id"])->paginate(15);
            $permission_groups = PermissionGroup::all();

            return view('users.roles.index', compact('roles', 'permission_groups'));
        } else {
            return view('place_holder');
        }
    }

    public function show($id)
    {
        $this->authorize('settings-roles', User::class);

        $role = Role::find($id);

        if(!$role){
            $this->flashMessage('warning', 'Permission not found!', 'danger');            
            return redirect()->route('role');
        }  

        $permissions_ids = Permission::permissionsRole($role);

        $permission_groups = PermissionGroup::all();                       

        return view('users.roles.show',compact('role', 'permissions_ids', 'permission_groups'));
    }

    public function create()
    {
        $this->authorize('settings-roles', Role::class);

        $permission_groups = PermissionGroup::all();

        return view('users.roles.create', compact('permission_groups'));
    }

    public function store(StoreRoleRequest $request)
    {
        $this->authorize('settings-roles', Role::class);

        $request->validate([
            'name' => 'required|unique:roles',
        ]);

        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $result = array_merge($request->all(), ['company_id' => $_COOKIE["company_id"]]);

            $role = Role::create($result);

            $permissions = $request->input('permissions') ? $request->input('permissions') : [];

            $role->permissions()->sync($permissions);

            $this->flashMessage('check', 'Permission successfully added!', 'success');
        }

        return redirect()->route('role');
    }

    public function edit($id)
    { 
        $this->authorize('settings-roles', Role::class);

        $role = Role::find($id);

        if(!$role){
            $this->flashMessage('warning', 'Permission not found!', 'danger');            
            return redirect()->route('role');
        }  

        $permissions_ids = Permission::permissionsRole($role);

        $permission_groups = PermissionGroup::all();

        return view('users.roles.edit',compact('role', 'permission_groups', 'permissions_ids'));
    }

    public function update(UpdateRoleRequest $request,$id)
    {
        $this->authorize('settings-roles', User::class);

        $role = Role::find($id);

        if(!$role){
            $this->flashMessage('warning', 'Permission not found!', 'danger');            
            return redirect()->route('role');
        }

        $role->update($request->all());

        $permissions = $request->input('permissions') ? $request->input('permissions') : [];

        $role->permissions()->sync($permissions);

        $this->flashMessage('check', 'Permission successfully updated!', 'success');

        return redirect()->route('role');
    }

    public function destroy($id)
    {
        $this->authorize('settings-roles', Role::class);

        $role = Role::find($id);

        if(!$role){
            $this->flashMessage('warning', 'Permiss??o n??o encontrada!', 'danger');            
            return redirect()->route('role');
        }

        $role->delete();

        $this->flashMessage('check', 'Permission successfully deleted!', 'success');

        return redirect()->route('role');
    }
}
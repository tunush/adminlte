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
        $config = Config::find(1);
        $this->authorize('show-role', Role::class);

        $roles = Role::paginate(15);

        $permission_groups = PermissionGroup::all();

        return view('users.roles.index', compact('roles', 'permission_groups', 'config'));
    }

    public function show($id)
    { 
        $config = Config::find(1);
        $this->authorize('show-role', User::class);

        $role = Role::find($id);

        if(!$role){
            $this->flashMessage('warning', 'Permission not found!', 'danger');            
            return redirect()->route('role');
        }  

        $permissions_ids = Permission::permissionsRole($role);

        $permission_groups = PermissionGroup::all();                       

        return view('users.roles.show',compact('role', 'permissions_ids', 'permission_groups', 'config'));
    }

    public function create()
    {
        $config = Config::find(1);
        $this->authorize('create-role', Role::class);

        $permission_groups = PermissionGroup::all();

        return view('users.roles.create', compact('permission_groups', 'config'));
    }

    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create-role', Role::class);

        // die(var_dump($request->all()));

        $request->validate([
            'name' => 'required|unique:roles',
        ]);

        $role = Role::create($request->all());

        $permissions = $request->input('permissions') ? $request->input('permissions') : [];

        $role->permissions()->sync($permissions);

        $this->flashMessage('check', 'Permission successfully added!', 'success');

        return redirect()->route('role');
    }

    public function edit($id)
    { 
        $config = Config::find(1);
        $this->authorize('edit-role', Role::class);

        $role = Role::find($id);

        if(!$role){
            $this->flashMessage('warning', 'Permission not found!', 'danger');            
            return redirect()->route('role');
        }  

        $permissions_ids = Permission::permissionsRole($role);

        $permission_groups = PermissionGroup::all();

        return view('users.roles.edit',compact('role', 'permission_groups', 'permissions_ids', 'config'));
    }

    public function update(UpdateRoleRequest $request,$id)
    {
        $this->authorize('edit-role', User::class);

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
        $this->authorize('destroy-role', Role::class);

        $role = Role::find($id);

        if(!$role){
            $this->flashMessage('warning', 'Permissão não encontrada!', 'danger');            
            return redirect()->route('role');
        }

        $role->delete();

        $this->flashMessage('check', 'Permission successfully deleted!', 'success');

        return redirect()->route('role');
    }
}
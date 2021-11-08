<?php 

namespace App\Http\Controllers\User; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;  
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdatePasswordUserRequest;
use App\Models\User; 
use App\Models\Role; 
use Illuminate\Support\Facades\Mail;
use App\Models\Config;

class UserController extends Controller 
{ 
    public function index()
    { 
        $config = Config::find(1);
        $this->authorize('show-user', User::class);

        $users = User::paginate(15);

        return view('users.index', compact('users', 'config'));
    }

    public function show($id)
    { 
    	$config = Config::find(1);
        $this->authorize('show-user', User::class);

    	$user = User::find($id);

    	if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }  

        $roles = Role::all();

		$roles_ids = Role::rolesUser($user);      	               

        return view('users.show',compact('user', 'roles', 'roles_ids', 'config'));
    }

    public function create()
    {
        $config = Config::find(1);
        $this->authorize('create-user', User::class);

        $roles = Role::all();

        return view('users.create',compact('roles', 'config'));
    }

    public function store(StoreUserRequest $request)
    {
        $from = "admin@example.com";
        $to = $request->input('email');
        $subject = "Invitation";
        $headers = "From: " . $from;

        $this->authorize('create-user', User::class);

        $request->merge(['password' => bcrypt($request->get('password'))]);

        $user = User::create($request->all());

        $roles = $request->input('roles') ? $request->input('roles') : [];

        $user->roles()->sync($roles);

        $message = '<h3>Personalized message</h3><div>'.$request->input('message').'</div>';
        mail($to, $subject, $message, $headers);

        $this->flashMessage('check', 'User successfully added!', 'success');

        return redirect()->route('user');
    }

    public function edit($id)
    { 
    	$config = Config::find(1);
        $this->authorize('edit-user', User::class);

    	$user = User::find($id);

    	if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }  

        $roles = Role::all();

		$roles_ids = Role::rolesUser($user);       	               

        return view('users.edit',compact('user', 'roles', 'roles_ids', 'config'));
    }

    public function update(UpdateUserRequest $request,$id)
    {
    	$this->authorize('edit-user', User::class);

    	$user = User::find($id);

        if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }

        $user->update($request->all());

        $roles = $request->input('roles') ? $request->input('roles') : [];

        $user->roles()->sync($roles);

        $this->flashMessage('check', 'User updated successfully!', 'success');

        return redirect()->route('user');
    }

    public function updatePassword(UpdatePasswordUserRequest $request,$id)
    {
    	$this->authorize('edit-user', User::class);

    	$user = User::find($id);

        if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }

        $request->merge(['password' => bcrypt($request->get('password'))]);

        $user->update($request->all());

        $this->flashMessage('check', 'User password updated successfully!', 'success');

        return redirect()->route('user');
    }

    public function editPassword($id)
    { 
    	$this->authorize('edit-user', User::class);

    	$user = User::find($id);

    	if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }              	               

        return view('users.edit_password',compact('user'));
    }

    public function destroy($id)
    {
        $this->authorize('destroy-user', User::class);

        $user = User::find($id);

        if(!$user){
            $this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }

        $user->delete();

        $this->flashMessage('check', 'User successfully deleted!', 'success');

        return redirect()->route('user');
    }
}
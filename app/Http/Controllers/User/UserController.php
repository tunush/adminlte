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
        $this->authorize('show-user', User::class);

        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $users = User::where('company_id', $_COOKIE["company_id"])->paginate(15);
            return view('users.index', compact('users'));
        } else {
            return view('place_holder');
        }
    }

    public function show($id)
    { 
        $this->authorize('show-user', User::class);

    	$user = User::find($id);

    	if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }  

        $roles = Role::all();

		$roles_ids = Role::rolesUser($user);      	               

        return view('users.show',compact('user', 'roles', 'roles_ids'));
    }

    public function create()
    {
        $this->authorize('create-user', User::class);

        $roles = Role::all();

        return view('users.create',compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $from = "admin@example.com";
        $to = $request->input('email');
        $subject = "Invitation";
        $headers = "From: " . $from;

        $this->authorize('create-user', User::class);

        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $message = '<div>URL the login area: <a href="http://localhost:8000/login/'.$_COOKIE["company_id"].'">http://localhost:8000/login/'.$_COOKIE["company_id"].'</a></div>
                    <div>Login: '.$request->input('email').'</div>
                    <div>Password: '.$request->input('email').'</div>
                    <div>Personalized message: '.$request->input('message').'</div>';

            $request->merge(['password' => bcrypt($request->input('email'))]);
            
            $result = array_merge($request->all(), ['company_id' => $_COOKIE["company_id"]]);
        
            $user = User::create($result);

            $roles = $request->input('roles') ? $request->input('roles') : [];

            $user->roles()->sync($roles);

            mail($to, $subject, $message, $headers);

            $this->flashMessage('check', 'User successfully added!', 'success');
        }

        return redirect()->route('user');
    }

    public function sendInvintation($id) {
        $user = User::find($id);

        $from = "admin@example.com";
        $to = $user->email;
        $subject = "Invitation";
        $headers = "From: " . $from;

        $message = '<div>URL the login area: <a href="http://localhost:8000/login/'.$_COOKIE["company_id"].'">http://localhost:8000/login/'.$_COOKIE["company_id"].'</a></div>
                    <div>Login: '.$user->email.'</div>
                    <div>Password: '.$user->email.'</div>';

        mail($to, $subject, $message, $headers);

        $this->flashMessage('check', 'Invintation has been sent successfully!', 'success');

        return redirect()->route('user');
    }

    public function edit($id)
    {
        $this->authorize('edit-user', User::class);

    	$user = User::find($id);

    	if(!$user){
        	$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }  

        $roles = Role::all();

		$roles_ids = Role::rolesUser($user);       	               

        return view('users.edit',compact('user', 'roles', 'roles_ids'));
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
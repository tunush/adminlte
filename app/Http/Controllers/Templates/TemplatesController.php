<?php 

namespace App\Http\Controllers\Templates; 

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\StoreRoleRequest;
use App\Http\Requests\User\UpdateRoleRequest; 
use Illuminate\Http\Request; 
use App\Models\User;
use App\Models\Templates;
use App\Models\Config;

class TemplatesController extends Controller 
{ 
	public function __construct() 
	{ 
		$this->middleware("auth");
	} 

	public function index() 
	{
        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $data = Templates::where('company_id', $_COOKIE["company_id"])->paginate(15);
            return view('templates.index', compact('data'));
        } else {
            return view('templates.index');
        }
	}

	public function store(StoreRoleRequest $request) {
        $request->validate([
            'name' => 'required|unique:templates',
        ]);
        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $result = array_merge($request->all(), ['company_id' => $_COOKIE["company_id"]]);
            $template = Templates::create($result);
            $this->flashMessage('check', 'Template successfully added!', 'success');
        }

        return redirect()->route('manage_templates');
    }

    public function update(StoreRoleRequest $request, $id)
    {
        $template = Templates::find($id);

        $template->update($request->all());

        $this->flashMessage('check', 'Template successfully updated!', 'success');

        return redirect()->route('manage_templates');
    }

    public function destroy($id)
    {
        $template = Templates::find($id);

        $template->delete();

        $this->flashMessage('check', 'Template successfully deleted!', 'success');

        return redirect()->route('manage_templates');
    }
}
<?php 

namespace App\Http\Controllers\DefaultFields; 

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\StoreRoleRequest;
use App\Http\Requests\User\UpdateRoleRequest; 
use Illuminate\Http\Request; 
use App\Models\User;
use App\Models\Templates;
use App\Models\TemplateDefaultFields;
use App\Models\Config;

class TemplateDefaultFieldsController extends Controller 
{ 
	public function __construct() 
	{ 
		$this->middleware("auth");
	} 

	public function index() 
	{
        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $data = Templates::where('company_id', $_COOKIE["company_id"])->get();
            return view('default_fields.index', compact('data'));
        } else {
            return view('default_fields.index');
        }
	}

    public function show($id) {
        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $template_name = Templates::find($id)->menu_name;
            $fields = TemplateDefaultFields::where('company_id', $_COOKIE["company_id"])->where('template_id', $id)->get();
            return view('default_fields.showTemplateDefaultFields', compact('id', 'template_name', 'fields'));
        } else {
            return view('default_fields.index');
        }
    }

	public function store(StoreRoleRequest $request, $template_id) {
        $request->validate([
            'label' => 'required|unique:template_default_fields',
        ]);
        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $result = array_merge($request->all(), ['company_id' => $_COOKIE["company_id"]]);
            $result = array_merge($result, ['template_id' => $template_id]);
            $field = TemplateDefaultFields::create($result);
            $this->flashMessage('check', 'Default field successfully added!', 'success');
        }

        return redirect()->route('template_default_fields', $template_id);
    }

    public function update(StoreRoleRequest $request, $id, $template_id)
    {
        $field = TemplateDefaultFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Default field successfully updated!', 'success');

        return redirect()->route('template_default_fields', $template_id);
    }

    public function updateValue(StoreRoleRequest $request, $id, $template_id)
    {
        $field = TemplateDefaultFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Default field value successfully updated!', 'success');

        return redirect()->route('template_default_fields', $template_id);
    }

    public function updateDefaultOptions(StoreRoleRequest $request, $id, $template_id)
    {
        $field = TemplateDefaultFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Dropdown options successfully updated!', 'success');

        return redirect()->route('template_default_fields', $template_id);
    }

    public function destroy($id, $template_id)
    {
        $field = TemplateDefaultFields::find($id);

        $field->delete();

        $this->flashMessage('check', 'Default field successfully deleted!', 'success');

        return redirect()->route('template_default_fields', $template_id);
    }
}
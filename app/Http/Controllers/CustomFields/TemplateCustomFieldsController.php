<?php 

namespace App\Http\Controllers\CustomFields; 

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use App\Models\Role;
use App\Models\User;
use App\Models\Config;
use App\Models\Templates;
use App\Models\TemplateDefaultFields;
use App\Models\TemplateCustomFields;
use App\Models\TemplateCustomSections;
use App\Http\Requests\User\StoreRoleRequest;

class TemplateCustomFieldsController extends Controller 
{ 
	public function __construct() 
	{
		$this->middleware("auth");
	} 

	public function index() 
	{
		if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $data = Templates::where('company_id', $_COOKIE["company_id"])->get();
            return view('custom_fields.index', compact('data'));
        } else {
            return view('custom_fields.index');
        }
	}

	public function show($id)
	{
		if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $template_name = Templates::find($id)->menu_name;
            $data = TemplateCustomSections::where('company_id', $_COOKIE["company_id"])->where('template_id', $id)->orderBy('sort_id','asc')->get();
            $max_sort_id = TemplateCustomSections::where('company_id', $_COOKIE["company_id"])->where('template_id', $id)->max('sort_id');
            $fields = TemplateCustomFields::where('company_id', $_COOKIE["company_id"])->where('template_id', $id)->get();
            $default_fields = TemplateDefaultFields::where('company_id', $_COOKIE["company_id"])->where('template_id', $id)->get();
            return view('custom_fields.showTemplateCustomFields', compact('id', 'template_name', 'data', 'max_sort_id', 'fields', 'default_fields'));
        } else {
            return view('custom_fields.index');
        }
	}

	public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));
            
            foreach($arr as $sortOrder => $id){
                $menu = TemplateCustomSections::find($id);
                $menu->sort_id = $sortOrder;
                $menu->save();
            }
            return ['success'=>true,'message'=>'Updated'];
        }
    }

	public function updateSection(StoreRoleRequest $request, $id, $template_id)
    {
        if(!$request->has('full')) {
            $result = array_merge($request->all(), ['full' => '0']);
        } else $result = $request->all();

        $section = TemplateCustomSections::find($id);

        $section->update($result);

        $this->flashMessage('check', 'Section successfully updated!', 'success');

        return redirect()->route('template_custom_fields', $template_id);
    }

	public function addSection(StoreRoleRequest $request, $template_id) {
        if(!$request->has('full')) {
            $result = array_merge($request->all(), ['full' => '0']);
        } else $result = $request->all();

        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $result = array_merge($result, ['company_id' => $_COOKIE["company_id"]]);
            $result = array_merge($result, ['template_id' => $template_id]);
            $section = TemplateCustomSections::create($result);
            $this->flashMessage('check', 'Section successfully added!', 'success');
        }

        return redirect()->route('template_custom_fields', $template_id);
    }

	public function destroySection($id, $template_id)
    {
        $section = TemplateCustomSections::find($id);

        $fields = TemplateCustomFields::where('section_id', $id)->get();
        foreach($fields as $f) {
            $field = TemplateCustomFields::find($f->id);
            $field->delete();
        }

        $section->delete();

        $this->flashMessage('check', 'Section successfully deleted!', 'success');

        return redirect()->route('template_custom_fields', $template_id);
    }

	public function store(StoreRoleRequest $request, $template_id) {
        if(isset($request->all()["label"]) && !isset($request->all()["default_field_id"])) {
            $request->validate([
                'label' => 'required|unique:template_custom_fields',
            ]);
        }
        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $result = array_merge($request->all(), ['company_id' => $_COOKIE["company_id"]]);
            $result = array_merge($result, ['template_id' => $template_id]);
            $field = TemplateCustomFields::create($result);
            $this->flashMessage('check', 'Custom field successfully added!', 'success');
        }

        return redirect()->route('template_custom_fields', $template_id);
    }

    public function update(StoreRoleRequest $request, $id, $template_id)
    {
        $field = TemplateCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Custom field successfully updated!', 'success');

        return redirect()->route('template_custom_fields', $template_id);
    }

    public function updateValue(StoreRoleRequest $request, $id, $template_id)
    {
        $field = TemplateCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Custom field value successfully updated!', 'success');

        return redirect()->route('template_custom_fields', $template_id);
    }

    public function updateDefaultOptions(StoreRoleRequest $request, $id, $template_id)
    {
        $field = TemplateCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Dropdown options successfully updated!', 'success');

        return redirect()->route('template_custom_fields', $template_id);
    }

    public function updateCustomOptions(StoreRoleRequest $request, $id, $template_id)
    {
        $field = TemplateCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Custom options successfully updated!', 'success');

        return redirect()->route('template_custom_fields', $template_id);
    }

    public function destroy($id, $template_id)
    {
        $field = TemplateCustomFields::find($id);

        $field->delete();

        $this->flashMessage('check', 'Custom field successfully deleted!', 'success');

        return redirect()->route('template_custom_fields', $template_id);
    }
}
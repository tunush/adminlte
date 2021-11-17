<?php 

namespace App\Http\Controllers\CustomFields; 

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use App\Models\Role;
use App\Models\User;
use App\Models\Config;
use App\Models\ContactDefaultFields;
use App\Models\ContactCustomFields;
use App\Models\ContactCustomSections;
use App\Http\Requests\User\StoreRoleRequest;

class ContactCustomFieldsController extends Controller 
{ 
	public function __construct() 
	{
		$this->middleware("auth");
	} 

	public function index() 
	{
		$config = Config::find(1);

		return view('custom_fields.index',compact('config'));
	}

	public function show() 
	{
		$config = Config::find(1);
		$data = ContactCustomSections::orderBy('sort_id','asc')->get();
		$max_sort_id = ContactCustomSections::max('sort_id');
		$fields = ContactCustomFields::all();
        $default_fields = ContactDefaultFields::all();
		return view('custom_fields.showContactCustomFields', compact('data', 'max_sort_id', 'fields', 'default_fields', 'config'));
	}

	public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));
            
            foreach($arr as $sortOrder => $id){
                $menu = ContactCustomSections::find($id);
                $menu->sort_id = $sortOrder;
                $menu->save();
            }
            return ['success'=>true,'message'=>'Updated'];
        }
    }

	public function updateSection(StoreRoleRequest $request, $id)
    {
        if(!$request->has('full')) {
            $result = array_merge($request->all(), ['full' => '0']);
        } else $result = $request->all();

        $section = ContactCustomSections::find($id);

        $section->update($result);

        $this->flashMessage('check', 'Section successfully updated!', 'success');

        return redirect()->route('contact_custom_fields');
    }

	public function addSection(StoreRoleRequest $request) {
        if(!$request->has('full')) {
            $result = array_merge($request->all(), ['full' => '0']);
        } else $result = $request->all();

        $config = Config::find(1);
        $section = ContactCustomSections::create($result);

        $this->flashMessage('check', 'Section successfully added!', 'success');

        return redirect()->route('contact_custom_fields');
    }

	public function destroySection($id)
    {
        $section = ContactCustomSections::find($id);

        $section->delete();

        $this->flashMessage('check', 'Section successfully deleted!', 'success');

        return redirect()->route('contact_custom_fields');
    }

	public function store(StoreRoleRequest $request, $id) {
        $config = Config::find(1);
        if(isset($request->all()["label"]) && !isset($request->all()["default_field_id"])) {
            $request->validate([
                'label' => 'required|unique:contact_custom_fields',
            ]);
        }
        $field = ContactCustomFields::create($request->all());

        $this->flashMessage('check', 'Custom field successfully added!', 'success');

        return redirect()->route('contact_custom_fields');
    }

    public function update(StoreRoleRequest $request, $id)
    {
        $field = ContactCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Custom field successfully updated!', 'success');

        return redirect()->route('contact_custom_fields');
    }

    public function updateValue(StoreRoleRequest $request, $id)
    {
        $field = ContactCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Custom field value successfully updated!', 'success');

        return redirect()->route('contact_custom_fields');
    }

    public function updateDefaultOptions(StoreRoleRequest $request, $id)
    {
        $field = ContactCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Dropdown options successfully updated!', 'success');

        return redirect()->route('contact_custom_fields');
    }

    public function updateCustomOptions(StoreRoleRequest $request, $id)
    {
        $field = ContactCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Custom options successfully updated!', 'success');

        return redirect()->route('contact_custom_fields');
    }

    public function destroy($id)
    {
        $field = ContactCustomFields::find($id);

        $field->delete();

        $this->flashMessage('check', 'Custom field successfully deleted!', 'success');

        return redirect()->route('contact_custom_fields');
    }
}
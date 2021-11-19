<?php 

namespace App\Http\Controllers\CustomFields; 

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use App\Models\Role;
use App\Models\User;
use App\Models\Config;
use App\Models\BuyerLeadsDefaultFields;
use App\Models\BuyerLeadsCustomFields;
use App\Models\BuyerLeadsCustomSections;
use App\Http\Requests\User\StoreRoleRequest;

class BuyerLeadsCustomFieldsController extends Controller 
{ 
	public function __construct() 
	{
		$this->middleware("auth");
	} 

	public function index() 
	{
		return view('custom_fields.index');
	}

	public function show() 
	{
		if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $data = BuyerLeadsCustomSections::where('company_id', $_COOKIE["company_id"])->orderBy('sort_id','asc')->get();
            $max_sort_id = BuyerLeadsCustomSections::where('company_id', $_COOKIE["company_id"])->max('sort_id');
            $fields = BuyerLeadsCustomFields::where('company_id', $_COOKIE["company_id"])->get();
            $default_fields = BuyerLeadsDefaultFields::where('company_id', $_COOKIE["company_id"])->get();
            return view('custom_fields.showBuyerLeadsCustomFields', compact('data', 'max_sort_id', 'fields', 'default_fields'));
        } else {
            return view('custom_fields.index');
        }
	}

	public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));
            
            foreach($arr as $sortOrder => $id){
                $menu = BuyerLeadsCustomSections::find($id);
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

        $section = BuyerLeadsCustomSections::find($id);

        $section->update($result);

        $this->flashMessage('check', 'Section successfully updated!', 'success');

        return redirect()->route('buyer_leads_custom_fields');
    }

	public function addSection(StoreRoleRequest $request) {
        if(!$request->has('full')) {
            $result = array_merge($request->all(), ['full' => '0']);
        } else $result = $request->all();

        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $result = array_merge($result, ['company_id' => $_COOKIE["company_id"]]);
            $section = BuyerLeadsCustomSections::create($result);
            $this->flashMessage('check', 'Section successfully added!', 'success');
        }

        return redirect()->route('buyer_leads_custom_fields');
    }

	public function destroySection($id)
    {
        $section = BuyerLeadsCustomSections::find($id);

        $section->delete();

        $this->flashMessage('check', 'Section successfully deleted!', 'success');

        return redirect()->route('buyer_leads_custom_fields');
    }

	public function store(StoreRoleRequest $request, $id) {
        if(isset($request->all()["label"]) && !isset($request->all()["default_field_id"])) {
            $request->validate([
                'label' => 'required|unique:buyer_leads_custom_fields',
            ]);
        }
        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $result = array_merge($request->all(), ['company_id' => $_COOKIE["company_id"]]);
            $field = BuyerLeadsCustomFields::create($result);
            $this->flashMessage('check', 'Custom field successfully added!', 'success');
        }

        return redirect()->route('buyer_leads_custom_fields');
    }

    public function update(StoreRoleRequest $request, $id)
    {
        $field = BuyerLeadsCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Custom field successfully updated!', 'success');

        return redirect()->route('buyer_leads_custom_fields');
    }

    public function updateValue(StoreRoleRequest $request, $id)
    {
        $field = BuyerLeadsCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Custom field value successfully updated!', 'success');

        return redirect()->route('buyer_leads_custom_fields');
    }

    public function updateDefaultOptions(StoreRoleRequest $request, $id)
    {
        $field = BuyerLeadsCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Dropdown options successfully updated!', 'success');

        return redirect()->route('buyer_leads_custom_fields');
    }

    public function updateCustomOptions(StoreRoleRequest $request, $id)
    {
        $field = BuyerLeadsCustomFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Custom options successfully updated!', 'success');

        return redirect()->route('buyer_leads_custom_fields');
    }

    public function destroy($id)
    {
        $field = BuyerLeadsCustomFields::find($id);

        $field->delete();

        $this->flashMessage('check', 'Custom field successfully deleted!', 'success');

        return redirect()->route('buyer_leads_custom_fields');
    }
}
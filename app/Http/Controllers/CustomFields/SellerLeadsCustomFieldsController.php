<?php 

namespace App\Http\Controllers\CustomFields; 

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use App\Models\Role;
use App\Models\User;
use App\Models\Config;
use App\Models\SellerLeadsCustomFields;
use App\Models\SellerLeadsCustomSections;
use App\Http\Requests\User\StoreRoleRequest;

class SellerLeadsCustomFieldsController extends Controller 
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
		$data = SellerLeadsCustomSections::orderBy('sort_id','asc')->get();
		$max_sort_id = SellerLeadsCustomSections::max('sort_id');
		$fields = SellerLeadsCustomFields::all();
		return view('custom_fields.showSellerLeadsCustomFields', compact('data', 'max_sort_id', 'fields', 'config'));
	}

	public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));
            
            foreach($arr as $sortOrder => $id){
                $menu = SellerLeadsCustomSections::find($id);
                $menu->sort_id = $sortOrder;
                $menu->save();
            }
            return ['success'=>true,'message'=>'Updated'];
        }
    }

	public function updateSection(StoreRoleRequest $request, $id)
    {
        $section = SellerLeadsCustomSections::find($id);

        $section->update($request->all());

        $this->flashMessage('check', 'Section successfully updated!', 'success');

        return redirect()->route('seller_leads_custom_fields');
    }

	public function addSection(StoreRoleRequest $request) {
        $config = Config::find(1);
        $section = SellerLeadsCustomSections::create($request->all());

        $this->flashMessage('check', 'Section successfully added!', 'success');

        return redirect()->route('seller_leads_custom_fields');
    }

	public function destroySection($id)
    {
        $section = SellerLeadsCustomSections::find($id);

        $section->delete();

        $this->flashMessage('check', 'Section successfully deleted!', 'success');

        return redirect()->route('seller_leads_custom_fields');
    }

	public function store(StoreRoleRequest $request, $id) {
        $config = Config::find(1);
        $request->validate([
            'label' => 'required|unique:seller_leads_custom_fields',
        ]);
        $field = SellerLeadsCustomFields::create($request->all());

        $this->flashMessage('check', 'Custom field successfully added!', 'success');

        return redirect()->route('seller_leads_custom_fields');
    }
}
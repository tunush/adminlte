<?php 

namespace App\Http\Controllers\DefaultFields; 

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\StoreRoleRequest;
use App\Http\Requests\User\UpdateRoleRequest; 
use Illuminate\Http\Request; 
use App\Models\User;
use App\Models\BuyerLeadsDefaultFields;
use App\Models\Config;

class BuyerLeadsDefaultFieldsController extends Controller 
{ 
	public function __construct() 
	{ 
		$this->middleware("auth");
	} 

	public function index() 
	{
		return view('default_fields.index');
	}

    public function show() {
        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $fields = BuyerLeadsDefaultFields::where('company_id', $_COOKIE["company_id"])->get();
            return view('default_fields.showBuyerLeadsDefaultFields', compact('fields'));
        } else {
            return view('default_fields.index');
        }
    }

	public function store(StoreRoleRequest $request) {
        $request->validate([
            'label' => 'required|unique:buyer_leads_default_fields',
        ]);
        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $result = array_merge($request->all(), ['company_id' => $_COOKIE["company_id"]]);
            $field = BuyerLeadsDefaultFields::create($result);
            $this->flashMessage('check', 'Default field successfully added!', 'success');
        }

        return redirect()->route('buyer_leads_default_fields');
    }

    public function update(StoreRoleRequest $request, $id)
    {
        $field = BuyerLeadsDefaultFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Default field successfully updated!', 'success');

        return redirect()->route('buyer_leads_default_fields');
    }

    public function updateValue(StoreRoleRequest $request, $id)
    {
        $field = BuyerLeadsDefaultFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Default field value successfully updated!', 'success');

        return redirect()->route('buyer_leads_default_fields');
    }

    public function updateDefaultOptions(StoreRoleRequest $request, $id)
    {
        $field = BuyerLeadsDefaultFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Dropdown options successfully updated!', 'success');

        return redirect()->route('buyer_leads_default_fields');
    }

    public function destroy($id)
    {
        $field = BuyerLeadsDefaultFields::find($id);

        $field->delete();

        $this->flashMessage('check', 'Default field successfully deleted!', 'success');

        return redirect()->route('buyer_leads_default_fields');
    }
}
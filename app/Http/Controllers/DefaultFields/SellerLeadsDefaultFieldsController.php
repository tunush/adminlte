<?php 

namespace App\Http\Controllers\DefaultFields; 

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\StoreRoleRequest;
use App\Http\Requests\User\UpdateRoleRequest; 
use Illuminate\Http\Request; 
use App\Models\User;
use App\Models\SellerLeadsDefaultFields;
use App\Models\Config;

class SellerLeadsDefaultFieldsController extends Controller 
{ 
	public function __construct() 
	{ 
		$this->middleware("auth");
	} 

	public function index() 
	{ 
		$config = Config::find(1);

		return view('default_fields.index',compact('config'));
	}

    public function show() {
        $config = Config::find(1);
        $fields = SellerLeadsDefaultFields::all();
        return view('default_fields.showSellerLeadsDefaultFields', compact('fields', 'config'));
    }

	public function store(StoreRoleRequest $request) {
        $config = Config::find(1);
        $request->validate([
            'label' => 'required|unique:seller_leads_default_fields',
        ]);
        $field = SellerLeadsDefaultFields::create($request->all());

        $this->flashMessage('check', 'Default field successfully added!', 'success');

        return redirect()->route('seller_leads_default_fields');
    }

    public function update(StoreRoleRequest $request, $id)
    {
        $field = SellerLeadsDefaultFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Default field successfully updated!', 'success');

        return redirect()->route('seller_leads_default_fields');
    }

    public function updateValue(StoreRoleRequest $request, $id)
    {
        $field = SellerLeadsDefaultFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Default field value successfully updated!', 'success');

        return redirect()->route('seller_leads_default_fields');
    }

    public function updateDefaultOptions(StoreRoleRequest $request, $id)
    {
        $field = SellerLeadsDefaultFields::find($id);

        $field->update($request->all());

        $this->flashMessage('check', 'Dropdown options successfully updated!', 'success');

        return redirect()->route('seller_leads_default_fields');
    }

    public function destroy($id)
    {
        $field = SellerLeadsDefaultFields::find($id);

        $field->delete();

        $this->flashMessage('check', 'Default field successfully deleted!', 'success');

        return redirect()->route('seller_leads_default_fields');
    }
}
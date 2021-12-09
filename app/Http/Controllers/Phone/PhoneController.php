<?php

namespace App\Http\Controllers\Phone;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Config;
use App\Http\Requests\User\StoreRoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\TwilloSettings;
use App\Models\TwilloNumbers;
//use Services_Twilio;

class PhoneController extends Controller
{
    //use InteractsWithQueue;
    //private $twilioClient;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $settings = TwilloSettings::where('company_id', $_COOKIE["company_id"])->get()[0];
            // $account_sid = $settings->account_sid;
            // $auth_token = $settings->auth_token;
            //$this->twilioClient = new Services_Twilio($account_sid, $auth_token);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            $settings = TwilloSettings::where('company_id', $_COOKIE["company_id"])->get()[0];
            $phones = TwilloNumbers::where('company_id', $_COOKIE["company_id"])->get();
            return view('phone.index', compact('settings', 'phones'));
        } else {
            return view('place_holder');
        }
    }

    public function updateSettings(StoreRoleRequest $request, $id)
    {
        $settings = TwilloSettings::find($id);

        $settings->update($request->all());

        $this->flashMessage('check', 'Twillo Settings successfully updated!', 'success');

        return redirect()->route('phone');
    }

    public function update(StoreRoleRequest $request, $id)
    {
        $phone = TwilloNumbers::find($id);
        
        $phone->update($request->all());

        if(!$request->has('name')) {
            return redirect()->route('profile');
        } else {
            $this->flashMessage('check', 'Phone number updated successfully!', 'success');
            return redirect()->route('phone');
        }
    }

    public function destroy($id)
    {
        $phone = TwilloNumbers::find($id);

        $phone->delete();

        $this->flashMessage('check', 'Phone number successfully deleted!', 'success');

        return redirect()->route('phone');
    }
}

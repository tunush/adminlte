<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;
use App\Http\Requests\ConfigRequest;
use Gate;
use App;

class ConfigController extends Controller
{    
    public function index()
    {
		if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] !== 0) {
			$config = Config::find($_COOKIE["company_id"]);

			$this->authorize('root-dev', $config);
				
			return view('config.index',compact('config'));
		} else {
			return view('config.index');
		}
    }

    public function update(ConfigRequest $request, $id)
    {   
        $this->authorize('root-dev', Config::class);

    	Config::find($id)->update($request->all());		

    	if($request->file('caminho_img_login')){
    		$file = $request->file('caminho_img_login');
    		$ext  = $file->guessClientExtension();			
            $path = $file->move("img/config", "logo.{$ext}");
    		Config::where('id', 1)->update(['caminho_img_login' => "img/config/logo.{$ext}"]);
    	}

    	if($request->file('favicon')){
    		$file = $request->file('favicon');
    		$ext  = $file->guessClientExtension();			
            $path = $file->move("img/config", "favicon.{$ext}");
    		Config::where('id', 1)->update(['favicon' => "img/config/favicon.{$ext}"]);
    	}

        $this->flashMessage('check', 'Application settings updated successfully!', 'success');

    	return redirect()->route('config');
    }
}

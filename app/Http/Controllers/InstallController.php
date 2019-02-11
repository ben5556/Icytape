<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class InstallController extends Controller
{
    public function install(Request $request){
    	if(!env('DB_DATABASE')){
    		$db_host = $request->hostname;
    		$db_name = $request->db_name;
    		$db_user = $request->db_user;
    		$db_pass = $request->db_pass;

    		$this->setEnvironmentValue('DB_HOST', $db_host);
    		$this->setEnvironmentValue('DB_DATABASE', $db_name);
    		$this->setEnvironmentValue('DB_USERNAME', $db_user);
    		$this->setEnvironmentValue('DB_PASSWORD', $db_pass);

			return redirect('/install_complete');
    	}
    	return redirect('/');
    }

    public function install_complete(){

		\Illuminate\Support\Facades\Artisan::call('migrate', ["--force"=> true ]);
		\Illuminate\Support\Facades\Artisan::call('db:seed');

		return redirect('/')->with( array('alert' => 'Congratulations! You have successfully installed the script.', 'alert-type' => 'success') );
    }

    private function setEnvironmentValue($envKey, $envValue)
	{

		file_put_contents(app()->environmentFilePath(), str_replace(
	        $envKey . '=' . env($envKey),
	        $envKey . '=' . $envValue,
	        file_get_contents(app()->environmentFilePath())
	    ));

	}
}

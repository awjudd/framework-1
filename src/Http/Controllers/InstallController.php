<?php
namespace Haunt\Http\Controllers;

use Haunt\Facades\Haunt;
use Haunt\Extend\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class InstallController extends Controller
{
	public function index()
	{
		if(!Haunt::canMakeDatabaseConnection()) {
			return view('haunt::install.index', [
				'step' => 'database',
			]);
		}

		if(!Haunt::hasSetupSite()) {
			return view('haunt::install.index', [
				'step' => 'site',
			]);
		}
	}

	public function store()
	{
		switch(request()->input('step')) {
			case 'database': {
				$validator = Validator::make(request()->all(), [
					'database_name' => ['required'],
					'database_username' => ['required'],
					'database_password' => ['required'],
					'database_host' => ['required'],
				]);

				if($validator->fails()) {
					return redirect()->back()->withErrors($validator);
				}

				Haunt::setEnvironmentValue('DB_DATABASE', $validator->validated()['database_name']);
				Haunt::setEnvironmentValue('DB_USERNAME', $validator->validated()['database_username']);
				Haunt::setEnvironmentValue('DB_PASSWORD', $validator->validated()['database_password']);
				Haunt::setEnvironmentValue('DB_HOST', $validator->validated()['database_host']);

				return redirect()->back();
			}
			case 'site': {
				$validator = Validator::make(request()->all(), [
					'site_name' => ['required'],
					'email_address' => ['required', 'email'],
					'password' => ['required', 'min:8'],
					'date_of_birth' => ['required', 'date'],
					'username' => ['required', 'min:3', 'max:15'],
				]);

				if($validator->fails()) {
					return redirect()->back()->withErrors($validator);
				}

				Haunt::setEnvironmentValue('APP_NAME', '"'.$validator->validated()['site_name'].'"');

				$auth = [
					'email_address' => $validator->validated()['email_address'],
					'password_hash' => Hash::make($validator->validated()['password']),
					'date_of_birth' => $validator->validated()['date_of_birth'],
					'username' => $validator->validated()['username'],
				];

				file_put_contents(Haunt::getAuthStorage(), json_encode($auth));

				Artisan::call('haunt:install');

				Haunt::setEnvironmentValue('HAUNT_INSTALLED', true);

				return redirect()->back();
			}
		}
	}
}

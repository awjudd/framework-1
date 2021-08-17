<?php
namespace Haunt\Library\Classes;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class HauntUserProvider implements UserProvider
{
	public function retrieveById($identifier)
	{
		dd('retrieveById');
	}

	public function retrieveByToken($identifier, $token)
	{
		dd('retrieveByToken');
	}

	public function updateRememberToken(Authenticatable $user, $token)
	{
		dd('updateRememberToken');
	}

	public function retrieveByCredentials(array $credentials)
	{
		dd('retrieveByCredentials');
	}

	public function validateCredentials(Authenticatable $user, array $credentials)
	{
		dd('validateCredentials');
	}
}

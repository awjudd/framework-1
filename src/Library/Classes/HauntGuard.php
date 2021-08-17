<?php
namespace Haunt\Library\Classes;

use Haunt\Facades\Haunt;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Hash;
use Haunt\Library\Classes\HauntUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class HauntGuard implements Guard
{
	/**
	 * The request data.
	 * @var \Illuminate\Http\Request
	 */
	protected Request $request;

	/**
	 * The user model.
	 * @var \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	protected ?Authenticatable $user;

	/**
	 * Create a new guard instance.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return void
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->user = null;
	}

	/**
	 * Determine if the current user is authenticated.
	 *
	 * @return bool
	 */
	public function check(): bool
	{
		return !is_null($this->user());
	}

	/**
	 * Determine if the current user is a guest.
	 *
	 * @return bool
	 */
	public function guest(): bool
	{
		return !$this->check();
	}

	/**
	 * Get the currently authenticated user.
	 *
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function user(): ?Authenticatable
	{
		if(!is_null($this->user)) {
			return $this->user;
		}

		$id = session()->get($this->getName());

		if(!is_null($id)) {
			$this->user = $this->retrieveById($id);
		}

		return $this->user;
	}

	/**
	 * Set the current user.
	 *
	 * @param \Illuminate\Contracts\Auth\Authenticatable $user
	 * @return void
	 */
	public function setUser(Authenticatable $user): void
	{
		$this->user = $user;
	}

	/**
	 * Validate a user's credentials.
	 *
	 * @return bool
	 */
	public function validate(array $credentials = []): bool
	{
		return true;
	}

	/**
	 * Get the ID for the currently authenticated user.
	 *
	 * @return string|null
	*/
	public function id(): ?string
	{
		if($user = $this->user()) {
			return $this->user()->getAuthIdentifier();
		}
	}

    /**
     * Get a unique identifier for the auth session value.
     *
     * @return string
     */
    public function getName()
    {
        return 'login_haunt_'.sha1(static::class);
    }

	public function attempt(array $credentials): bool
	{
		$instance = $this->getUserModel();

		if($this->isUsingJsonFile($instance)) {
			$data = $this->getJsonFileContents();

			if(($data['email_address'] === $credentials['email_address']) && (Hash::check($credentials['password'], $data['password_hash']))) {
				session()->put($this->getName(), $credentials['email_address']);
				return true;
			} else {
				dd('failed');
			}
		}

		$user = $instance->where('email_address', '=', $credentials['email_address'])->first();

		if(!$user || !Hash::check($credentials['password'], $user->password)) {
			dd('failed');
		}
		session()->put($this->getName(), $credentials['email_address']);
		return true;
	}

	private function getUserModel()
	{
		$class = Haunt::getAuthModel();
		return new $class;
	}

	private function isUsingJsonFile($instance): bool
	{
		return $instance->getTable() === '';
	}

	private function getJsonFileContents(): array
	{
		return json_decode(file_get_contents(Haunt::getAuthStorage()), true);
	}

	private function retrieveById(string $identifier)
	{
		$instance = $this->getUserModel();

		if($this->isUsingJsonFile($instance)) {
			$data = $this->getJsonFileContents();
			$instance->uid = 1;
			$instance->email_address = $data['email_address'];
			$instance->password = $data['password_hash'];
			$instance->date_of_birth = $data['date_of_birth'];
			$instance->username = $data['username'];

			return $instance;
		}

		return $instance->where('email_address', '=', $identifier)->first();
	}
}

<?php
namespace Haunt\Entities\Models;

use Haunt\Library\Classes\Authenticatable;

class User extends Authenticatable
{
	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = '';

	/**
	 * Get the user's full username.
	 *
	 * @return string
	 */
	public function getFullUsernameAttribute(): string
	{
		return "{$this->username} (#{$this->uid})";
	}

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'email_address';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     * @codeCoverageIgnore
     */
    public function getRememberToken()
    {
        throw new \BadMethodCallException('Unexpected method call');
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     * @codeCoverageIgnore
     */
    public function setRememberToken($value)
    {
        throw new \BadMethodCallException('Unexpected method call');
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     * @codeCoverageIgnore
     */
    public function getRememberTokenName()
    {
        throw new \BadMethodCallException('Unexpected method call');
    }
}

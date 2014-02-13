<?php

use Illuminate\Auth\UserInterface;

class Admin extends Eloquent implements UserInterface
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'admins';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

    /**
     * Available statuses for user account
     */
    const status_inactive = 0;
    const status_active = 1;

    /**
     * List of all statuses
     *
     * @var array
     */
    public static $aStatuses = array(self::status_inactive, self::status_active);


    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
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

}
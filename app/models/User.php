<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

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
    const status_banned = 2;

    /**
     * List of all statuses
     *
     * @var array
     */
    public static $aStatuses = array(self::status_inactive, self::status_active, self::status_banned);


    /**
     * function comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('\Comment');
    }


    /**
     * Generate an hash used be hash field in User model
     *
     * @return string
     */
    public static function generateHash()
    {
        return hash('md5', time().time().str_random(60));
    }

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

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}
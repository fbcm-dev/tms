<?php

namespace TMS\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
	use Notifiable;
	use CrudTrait;
    use HasRoles;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'username', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPasswordNotification($token));
	}

    /**
     *
     * Generates username
     *
     * @param $name
     * @return string
     */
    protected function generateUsername($name){
        $expFirstName = explode(' ', $name);
        $last_name = end($expFirstName);
        $nameInitial = $last_name;

        foreach ($expFirstName as $key) {
            if($key != $last_name){
                $tempNameInitial = substr($key, 0, 1);
                $nameInitial .= $tempNameInitial;
            }
        }

        return strtolower($nameInitial);
    }

    /**
     *
     * Generate 7 digits password
     *
     * @return string
     */
    protected function generatePassword(){
        $string_set = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz^!@$';
        $password = '';
        for ($i=0; $i <= 6; $i++) {
            $rand = rand(1, 62);
            $shuffle = str_shuffle(substr($string_set, $rand, ($rand-$i) ));
            $password .= substr($shuffle, 1, 1);
        }
        return $password;
    }
}

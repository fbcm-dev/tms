<?php 

namespace TMS\Models\Observers;

use TMS\Models\User;
use Mail;
use TMS\Mail\UserCreated;

/**
* Observer class to listen to User Model
*/
class UserObserver
{
	
	public function created(User $user)
	{
		$user->hashPassword();
	}

	public function creating(User $user)
	{
		$user->generateCredentials();
		
		Mail::to($user->email)->send(new UserCreated($user));
	}
}
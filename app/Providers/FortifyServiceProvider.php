<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Profile;
use App\Models\Userpartner;
use Hash;


class FortifyServiceProvider extends ServiceProvider
{
	/**
	* Register any application services.
	*
	* @return void
	*/
	public function register()
	{
		//
	}

	/**
	* Bootstrap any application services.
	*
	* @return void
	*/
	public function boot()
	{
		Fortify::createUsersUsing(CreateNewUser::class);
		Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
		Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
		Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

		Fortify::authenticateUsing(function (LoginRequest $request) {
			$user = User::where('email', $request->username)
			->orWhere('username', $request->username)->first();

            if ($user && Hash::check($request->password, $user->password)) {
			    if ($user->hasPermissionTo('akademik access') || $user->hasRole(['developer', 'administrator'])) {
                    if(!$user->profile)	Profile::create(['user_id' => $user->id]);
                    if(!$user->partner)	Userpartner::create(['user_id' => $user->id]);
                    return $user;
                }
			}
		});

		RateLimiter::for('login', function (Request $request) {
			return Limit::perMinute(5)->by($request->email.$request->ip());
		});

		RateLimiter::for('two-factor', function (Request $request) {
			return Limit::perMinute(5)->by($request->session()->get('login.id'));
		});
	}
}

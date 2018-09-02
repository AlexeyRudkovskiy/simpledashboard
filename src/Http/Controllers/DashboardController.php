<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 23.08.18
 * Time: 20:51
 */

namespace ARudkovskiy\Admin\Http\Controllers;


use ARudkovskiy\Admin\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function signIn()
    {
        return view('@admin::auth.signin');
    }

    public function signInCheck(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $user = User::where('username', $username)->firstOrFail();
        $hash = implode('@', [ $user->id, $password ]);

        if (\Hash::check($hash, $user->password)) {
            session()->put('user_id', $user->id);
            $redirectTo = session()->get('_redirect_to', null);
            if ($redirectTo !== null) {
                session()->remove('_redirect_to');
                return redirect($redirectTo);
            }
            return redirect()->route('admin.dashboard');
        }
    }

}
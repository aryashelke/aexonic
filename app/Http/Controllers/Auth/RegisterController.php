<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\StateMaster;
use App\CountryMaster;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'pincode' => 'required|string|min:6',
            'contact' => 'required|string|min:10',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required|string|max:255',
            // 'profile_image' => 'required|image',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data, $file_path)
    {

        logger()->debug("User data :: " , $data);

        // var_dump($data);
        // var_dump($file_path);
        //     die();

        try{

            return User::create([
                'city' => $data['city'],
                'name' => $data['name'],
                'email' => $data['email'],
                'contact' => $data['contact'],
                'profile_image' => $file_path,
                'pincode' => $data['pincode'],
                'state_id' => $data['state'],
                'country_id' => $data['country'],
                'password' => bcrypt($data['password']),
            ]);

        }catch (Exception $e){
            logger()->debug("Exception occures while inserting new user :: ", [$e]);
        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $state_list = StateMaster::select('id', 'name')->where('status', StateMaster::STATUS_ACTIVE)->get();
        $country_list = CountryMaster::select('id', 'name')->where('status', CountryMaster::STATUS_ACTIVE)->get();

        return view('auth.register', [
            'country_list' => $country_list,
            'state_list' => $state_list,
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $file = $request->file('profile_image');
        $file_path = Storage::putFileAs('profile-image', $file, $file->getClientOriginalName());
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all(), $file_path)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}

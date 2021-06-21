<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\StudentDetails;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/login';

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact' => ['required', 'string'],
            'rollno' =>['required', 'numeric'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $enrollno = $data['department'].$data['section'].date("Ys");
        $role = 'student';

        $addstud = new User();
        $addstud->name = $data['name'];
        $addstud->email = $data['email'];
        $addstud->password = Hash::make($data['password']);

        $addstud->save();

        $addstuddetails = new StudentDetails();
        $addstuddetails->contact_no = $data['contact'];
        $addstuddetails->roll_no = $data['rollno'];
        $addstuddetails->enroll_no = $enrollno;
        $addstuddetails->semester = $data['semester'];
        $addstuddetails->section = $data['section'];
        $addstuddetails->department = $data['department'];

        $addstud->studentdetails()->save($addstuddetails);

        $rolecheck = Role::where('role_name', $role)->first();
        $addstud->roles()->attach($rolecheck);

        foreach($rolecheck->permissions as $val) {
            $permcheck = Permission::where('permission_name', $val->permission_name)->firstOrFail();
            $addstud->permissions()->attach($permcheck);
        }

        return $addstud;
    }
}

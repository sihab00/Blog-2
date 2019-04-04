<?php

namespace App\Http\Controllers\backend;

use Session;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use Mail;
use App\Mail\VarificationEmail;
use Carbon\Carbon;
use Queue;
use Notification;
use App\Notifications\VerifyEmail;
use App\Notifications\NotifyAdmin;

class FrontController extends Controller
{
    public function index()
    {
    	
      $articles = cache('articles', function(){
        return Post::with('user','category')->orderBy('created_at','desc')->get();
      });
     
    	return view('welcome')->withArticles($articles);
    }
    public function contact()
    {
    	return view('contact');
    }

    public function registerForm(Request $request)
    {
       return view('register');
    }
    public function processRegister(Request $request)
    {
       // $this->validate($request, [
       //      'email'=>'required|email',
       //      'password'=>'required|min:6'
       //  ]);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users,email',
            'username'=>'required|unique:users,username',
            'password' => 'required|min:6',
            'phone_number'=>'required|unique:users,phone_number',
            'image' =>'required|image|max:10240'
        ]);

        if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
        }

        $photo = $request->file('image');

        $fileName= uniqid('photo',true).str_random(10).'.'.$photo->getClientOriginalExtension();

        if ($photo->isValid()) {
            $photo->storeAs('images',$fileName);
        }
        // $user = User::create([
        //   'email'=>trim($request->input('email')),
        //   'username'=>trim($request->input('username')),
        //   'password' =>bcrypt($request->input('password')),
        //   'photo'=>$fileName,
        //   'email_verification_token'=>str_random(32),

        //   ]);
        $user = new User();
        $user->email = trim($request->input('email'));
        $user->username = trim($request->input('username'));
        $user->password = bcrypt($request->input('password'));
        $user->phone_number=trim($request->input('phone_number'));
        $user->photo = $fileName;
        $user->email_verification_token = str_random(32);
        $user->save();

        //Mail::to($user->email)->queue(new VarificationEmail($user));
        $user->notify(new VerifyEmail($user));

        $admin = User::find(51);
        $admin->notify(new NotifyAdmin($user));
        Session::flash('success','Registration successfully complete!');

        return redirect()->back();
    }
     public function loginForm(Request $request)
    {
       return view('login');
    }

    public function processLogin(Request $request)
    {
       $rules=[
            'email'=>'required|email',
            'password'=>'required'
       ];

       $validator = Validator::make($request->all(), $rules);
       if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
       }
       $credentials = $request->except('_token');

       if (auth()->attempt($credentials)) {

            $user = auth()->user();
            $user->last_login = Carbon::now();
            $user->save();

            if ($user->email_verified == 0) {
              Session::flash('warning','Your account is not validated yet! so please validated your account');

              auth()->logout();

              return redirect()->route('login');
            }
          return redirect()->route('dashboard');
       }
    }
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
    public function dashboardShow()
    {
        $user = auth()->user();
       return view('backend.dashboard')->withUser($user);
    }

    public function verifyEmail($token)
    {
      if ($token == null) {
        Session::flash('warning','Empty token!');

        return redirect()->route('login');
      }

      $user = User::where('email_verification_token', $token)->first();

      if ($user == null) {
         Session::flash('warning','Ivalid token!');

        return redirect()->route('login');
      }

      $user->update([
        'email_verified'=>1,
        'email_verified_at'=>Carbon::now(),
        'email_verification_token'=>'',

        ]);
      Session::flash('success','Your account has been activated successfully. You can login now!');

      return redirect()->route('login');
    }
}

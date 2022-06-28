<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
Use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\PaypalPayment;
use Omnipay\Omnipay;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        private $gateway;


    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
        $this->middleware('guest');
    }

    // /**
    //  * Get a validator for an incoming registration request.
    //  *
    //  * @param  array  $data
    //  * @return \Illuminate\Contracts\Validation\Validator
    //  */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //        'userid' => ['required', 'string', 'max:255'],
    //         // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         // 'password' => ['required', 'string'],
    //         //'g-recaptcha-response' => settings('register_enable_recaptcha') == 'yes' ? 'recaptcha' : 'nullable',
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(Request $request)
    { 
        try {
        $response = $this->gateway->purchase(
            array(
                'amount' => '100',   //$order->total_price,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => route('register.success'),
                'cancelUrl' => route('register.cancel'),
                
              
            )
        )->send();
        
        $data = new User();
        $data->userid = $user_id  = $request->userid;
        $data->password = bcrypt($request->password);
        $data->firstname = $request->firstname;
        $data->lastname = $request->lastname;
        $data->dob = $request->dob;
        $data->parent_address = $request->parent_address;
        $data->parent_apt = $request->parent_apt;
        $data->parent_city = $request->parent_city;
        $data->parent_state = $request->parent_state;
        $data->parent_country = $request->parent_country;
        $data->parent_zip = $request->parent_zip;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->spouse_first_name = $request->spouse_first_name;
        $data->spouse_last_name = $request->spouse_last_name;
        $data->child_first_name = $request->child_first_name;
        $data->child_last_name = $request->child_last_name;
        $data->child_age = $request->child_age;
        $data->child_address = $request->child_address;
        $data->child_city = $request->child_city;
        $data->child_state = $request->child_state;
        $data->child_country = $request->child_country;
        $data->child_zip = $request->child_zip;
        $data->payment_status = "payment_done";
        $data->save();
        
 if ($response->isRedirect()) {
      $response->redirect();
       } else {
           return $response->getmessage() ;  
    }
 } catch (\throwable $ex) {
            DB::rollBack();
            logger('Error While adding new user.');
            report($ex);
            return $ex->getMessage();
        }
     return $user_id;

 }

public function registerSuccess(Request $request)
    {
        
      
            // $request->validate([
            //     'order_id' => 'required|exists:orders,id',
            //     'paymentId' => 'required',
            //     'token' => 'required',
            //     'PayerID' => 'required'
            // ]);
            if($request->input('paymentId') && $request->input('PayerID')){
                $transaction = $this->gateway->completePurchase(array(
                    'payer_id'            => $request->input('PayerID'),
                    'transactionReference' => $request->input('paymentId')
                ));     
                $response = $transaction->send();  
                if ($response->isSuccessful()) {
                    $arr_body = $response->getData();
    
                    $payment = new PaypalPayment;
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = env('PAYPAL_CURRENCY');
                    $payment->payment_status = $arr_body['state'];
                   
                    $payment->save();
                    
                    // $user= User::where('id','desc')->first();
                    // dd($user);
                    // $user->update([
                    //      "payment_status" => "payment_done",
                    //      'created_at'=> Carbon::now(),
                       
                       
                    // ]);
                
                        
                    
    
                    return redirect('login')->with('message','successfully registered '.$payment->payer_email);
                }
    else{
        return error;
    }
            }
             
          
      
        
    }

    // Method overwritten from RegistersUsers
    public function register(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = $this->validator($request->all());
            if ($validator->fails()) {
                return redirect()->route('register')
                    ->withErrors($validator, 'register')
                    ->withInput();
            }

            event(new Registered($user = $this->create($request->all())));

            DB::commit();

            $this->guard()->login($user);

            if ($response = $this->registered($request, $user)) {
                return $response;
            }

            return $request->wantsJson()
                ? new JsonResponse([], 201)
                : redirect($this->redirectPath());
        } catch (\Throwable $th) {
            DB::rollBack();
            logger('Error while registering user.');
            report($th);
            return back()
                ->with('unknown', 'Something went wrong while creating an account for you. Please try again later.')
                ->withInput();
        }
    }
    
    public function cancelled()
    {
        return redirect()->route('register')->with('error', 'Sorry the payment has been cancelled.');
    }

public function sendEmail()
{
    /** 
     * Store a receiver email address to a variable.
     */
    $reveiverEmailAddress = "np03a190240@heraldcollege.edu.np";

    /**
     * Import the Mail class at the top of this page,
     * and call the to() method for passing the 
     * receiver email address.
     * 
     * Also, call the send() method to incloude the
     * HelloEmail class that contains the email template.
     */
    Mail::to($reveiverEmailAddress)->send(new TestEmail());

    /**
     * Check if the email has been sent successfully, or not.
     * Return the appropriate message.
     */
    if (Mail::failures() != 0) {
        return "Email has been sent successfully.";
    }
    return "Oops! There was some error sending the email.";
}
}
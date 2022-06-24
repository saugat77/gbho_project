<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\AddUser;
use App\MAil\RegisterMail;
use Omnipay\Omnipay;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;


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
        $response = $this->gateway->purchase(
            array(
                'amount' => '100',   //$order->total_price,
                'currency' => settings('paypal_currency', 'USD'),
                'returnUrl' => route('paypal.success', [$request->userid]),
                'cancelUrl' => route('paypal.cancelled', [$request->userid]),
                
                // "items" => array(
                //     [
                //         'name' => 'Item Name',
                //         'price' => '10',
                //         'quantity' => 1,
                //     ]
                // )
            )
        )->send();
        $response->getData()['id'];
        $data = new User();
        $data->userid = $request->userid;
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
         $data->payment_status = "payment_pending";
        $data->save();
            if ($response->isRedirect()) {
           
                $response->redirect();
            } else {
                return $response->getMessage();
            }
                
   
}
public function success(Request $request)
    {
        
        try {
            // $request->validate([
            //     'order_id' => 'required|exists:orders,id',
            //     'paymentId' => 'required',
            //     'token' => 'required',
            //     'PayerID' => 'required'
            // ]);
            $transaction = $this->gateway->completePurchase([
                'payer_id' => $request->PayerID,
            ]);
              
            
            if ($response->isSuccessful()) {
                   $this->sendEmail($details);
                return redirect()->route('login')->with('message', 'Payment success for order #' . $user->id . '.');
               
            }

            throw new Exception('Something went wrong while processing your payment.');
        } catch (\Throwable $th) {
            report($th);
            return redirect()->back()->with('error', 'Something went wrong while processing your payment.');
        }
    }
    public function sendEmail($details){
        $details=[
            'title' =>'Mail from fest nepal',
            'body' => 'testing'
        ];
        Mail::to('saugatpandey4@gmail.com')->send(new RegisterMail($details));
        return 'Email sent';
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
//     public function newuser(Request $request){
//         $data = new AddUser;
//         $data->userid = $request->userid;
//         $data->password = bcrypt($request->password);
//         $data->firstname = $request->firstname;
//         $data->lastname = $request->lastname;
//         $data->dob = $request->dob;
//         $data->parent_address = $request->parent_address;
//         $data->parent_apt = $request->parent_apt;
//         $data->parent_city = $request->parent_city;
//         $data->parent_state = $request->parent_state;
//         $data->parent_country = $request->parent_country;
//         $data->parent_zip = $request->parent_zip;
//         $data->phone = $request->phone;
//         $data->email = $request->email;
//         $data->spouse_first_name = $request->spouse_first_name;
//         $data->spouse_last_name = $request->spouse_last_name;
//         $data->child_first_name = $request->child_first_name;
//         $data->child_last_name = $request->child_last_name;
//         $data->child_age = $request->child_age;
//         $data->child_address = $request->child_address;
//         $data->child_city = $request->child_city;
//         $data->child_state = $request->child_state;
//         $data->child_country = $request->child_country;
//         $data->child_zip = $request->child_zip;
//         $data->payment_status = "payment_pending";
//         $data->save();

//         return Redirect()->back()->with('message','added');
//     }
}
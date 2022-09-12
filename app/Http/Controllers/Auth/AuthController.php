<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\parameters;
use App\Models\company_master;
use App\Models\location_master;

use Hash;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $param_valueobj = parameters::select('param_value')
                           ->where('param_code', '=', 'APP_SRV_MULTI_COMP')
                           ->get();
        if($param_valueobj[0]['param_value']=='N')
        {
            $param_valueobjdefcomp = parameters::select('param_value')
                           ->where('param_code', '=', 'DEF_COMP')
                           ->get();
            $PostComp = company_master::select('comp_name','comp_code')
                           ->where('comp_code', '=', $param_valueobjdefcomp[0]['param_value'])
                           ->get();
        }
        else
        {
            $PostComp = company_master::select('comp_name','comp_code')
                           ->where('status', '=', 'Y')
                           ->get();

        }
        $param_valueloc = parameters::select('param_value')
                           ->where('param_code', '=', 'APP_SRV_MULTI_BR')
                           ->get();
        if($param_valueloc[0]['param_value']=='N')
        {
            $param_valueobjloc = parameters::select('param_value')
                            ->where('param_code', '=', 'DEF_LOC')
                            ->get();
            $PostLocation = location_master::select('loc_name','loc_code')
                            ->where('loc_code', '=', $param_valueobjloc[0]['param_value'])
                            ->get();
        }
        else{
            $PostLocation = location_master::select('loc_name','loc_code')
                            ->where('status', '=', 'Y')
                            ->get();
        }
        return view('auth.login',['PostComp' => $PostComp, 'PostLocation' => $PostLocation]);
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            session(['useremail' => $request->email]);
            session(['companyname' => $request->txt_company]);
            session(['companylocation' => $request->txt_location]);
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully logged-In');
        }
  
        return redirect("login")->withError('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
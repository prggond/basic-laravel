<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hint;
// use App\Models\Prince;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;

class Home extends Controller
{
    public function index( )
    {
        return view('home');
    
    }
     public function store(Request $request){
        $data=new Hint();
        $data->name=$request->input('name');
        $data->email=$request->input('email');
        $data->password=$request->input('password');
        $data->mobile=$request->input('mobile');
        $data->save();
        return redirect('/home')->with('success',"your msg sent successfully") ;
     }
     public  function fetch(Request $request ){
        $data=Hint::all();
        return view('fetch',['data'=>$data]);
     }
     public function delete($id){
        $data=Hint::findorfail($id);
        $data->delete();
     }
      public function update(Request $request, $id){
        $data= Hint::findorfail($id);
        $data->name=$request->input('name');
        $data->email=$request->input('email');
        $data->password=$request->input('password');
        $data->mobile=$request->input('mobile');
        $data->save();
        return redirect()->route('fetch')->with('success', 'Item updated successfully');

      }

//     public function store(Request $request){
//         $data=new Hint();
        
//         $data->name = $request->input('name');        
      
//         $data->email = $request->input('email');
//         $data->password = $request->input('password');
//         $data->mobile = $request->input('mobile');
//         $data->save();    
// }

// public function fetch(Request $request)
// {
//     $data=Hint::All();
//     return view('fetch',['data'=>$data]);

// }
// public function delete($id){
//     $data=Hint::findorFail($id);
   
//     $data->delete();
  
   
    
//     return redirect()->route('fetch')->with('success', 'Item deleted successfully');
// }


//  public function  update( Request $request, $id){
//     $data= Hint::findorFail($id);
//     $data->name=$request->input('name');
//     $data->name = $request->input('email');
//     $data->password = $request->input('password');
//     $data->mobile = $request->input('mobile');
//     $data->save();
//     return redirect()->route('fetch')->with('success', 'Item updated successfully');


    

//  }
 public function edit($id)
    {
      
        $data = Hint::findOrFail($id);
        return view('edit', ['item' => $data]);
    
    }
    //  public function register(){
       
    //     return view('register');
    //  }
    //  public function done(Request $request){
     
    //     $data= new Prince();   
        
    //     $data->name = $request->input('name');
    // $data->email = $request->input('email');
    // $data->password = $request->input('password');
    // $data->save();
    // Auth::login($data);

    // return redirect()->route('fetch')->with('success', 'Item created successfully');
    //  }
    //   public function login(Request $request){
    //     $credentials=$request->validate([
    //         'email'=>'requiere|email',
    //         'password'=>'required|password',
    //     ]);
    //     if(Auth::attempt($credentials))
    //     return redirect()->intended('/fetch');
      
    //   }


    public function done(Request $request){
    
      $request->validate([
         'name' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:users',
         'password' => 'required|string|confirmed|min:8',
     ]);
      $user=User::create([
         'name'=>request->name,
         'email'=>request->email,
         'password'=>Hash::make($request->password),
      ]);
      Auth::login($user);
      return redirect()->intended('/home');

      
    }
    public function loginform(){
      return view ('login');
    }
    public function login(Request $request){
      $request->validate([
         'email'=>'request|string',
         'password'=>'request|string',
      ]);
      $credentials=$request->only('email','password');
      if(Auth::attemp($credentials)){
         return redirect()->indented('/home');
      }
    }
    public function register(){
      return view('register');
    }

}

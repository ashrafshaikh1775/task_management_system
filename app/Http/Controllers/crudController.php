<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task_list;
class crudController extends Controller
{
    public function login(){
        return view('welcome');
    }
    public function signup(){
        return view('signup');
    }
   //signup user here
    public function registerUser(Request $request){
        $request->validate([
            'name'=>'required',
            'password'=>'required|min:5|max:12',
            'email'=>'required|email|unique:users',
            'mobile_number'=>'required|min:10|max:10'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->mobile_no = $request->mobile_number;
        $res = $user->save();
        if($res)
        {
             return back()->with('success','You are rergistered successfully');
        }
        else
        {
            return back()->with('fail','Something Wrong');
        }
    }
    //login user here
    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
    
        ]);
        $user = User::where('email','=', $request->email)->first();
        if($user){
               if($request->password == $user->password)
               {
                $request->session()->put('loginId' , $user->id);
                $request->session()->put('orderbydate' , 'ASC');
                $request->session()->put('orderbystatus' , 'all');
                return redirect('dashboard');
               }
               else{
                return back()->with('fail','Password not matches.');
               }
            }
            else
            {
                return back()->with('fail','This email is not registered.');
            }
       
    }
    //go to dashboard
    public function dashboard(Request $request){
        
        $data = array();
        if($request->session()->has('loginId'))
        {
         $data = User::where('id','=',$request->session()->get('loginId'))->first();
         if($request->session()->get('orderbystatus') == 'all')
         {
            $task_list = Task_list::where('user_id','=',$request->session()->get('loginId'))->orderBy('due_date', $request->session()->get('orderbydate'))->get();
         }
         else{
            $task_list = Task_list::where([['user_id','=',$request->session()->get('loginId')],['status','=',$request->session()->get('orderbystatus')]])->orderBy('due_date', $request->session()->get('orderbydate'))->get();
         }

        }
        return view('dashboard', ['data'=>$data , 'listOfTask'=>$task_list ,'orderbydate'=>$request->session()->get('orderbydate'), 'orderbystatus'=>$request->session()->get('orderbystatus')]); 
     }
   //add new task
     public function addNewTask(Request $request){
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'status'=>'required',
            'date'=>'required'
        ]);
        $user = new Task_list();
        $user->title = $request->title;
        $user->description = $request->description;
        $user->status = $request->status;
        $user->due_date = $request->date;
        $user->user_id = $request->session()->get('loginId');
        $res = $user->save();
        if($res)
        {
             return redirect('dashboard');
        }
        else
        {
            return back()->with('fail','Something Wrong');
        }
    }
    //delete task
    public function deleteTask(Request $request){
            if($request->session()->has('loginId'))
            {
                $request->session()->put('orderbydate' , $request->orderbydate);
                $request->session()->put('orderbystatus' , $request->orderbyselect);
             if(!empty(array_keys($request->post(),"Delete")))
             {
                $key = array_keys($request->post(),"Delete");
                $datas = Task_list::where('id','=',$key[0])->delete();
             }
            }
            return redirect('dashboard');
     
 

     }
     //edit task
     public function editTask(Request $request){
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'status'=>'required',
            'date'=>'required'
        ]);
        $key = array_keys($request->post(),"Edit");
        $user = Task_list::find($key[0]);
        $user->title = $request->title;
        $user->description = $request->description;
        $user->status = $request->status;
        $user->due_date = $request->date;
        $user->user_id = $request->session()->get('loginId');
        $res = $user->update();
        if($res)
        {
             return redirect('dashboard');
        }
        else
        {
            return back()->with('fail','Something Wrong');
        }
    }
    //logout user
    public function logoutUser(Request $request){
        $data = array();
        if($request->session()->has('loginId'))
        {
         $request->session()->pull('loginId');
         return redirect('');
        }
     }

}

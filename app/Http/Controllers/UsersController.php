<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class UsersController extends Controller
{
    public function users(){

        $users = User::get();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "User List"]
          ];
          return view('/content/user/users',[
            'breadcrumbs' => $breadcrumbs,
            'users' =>$users

          ]);
    }

    public function addUsers(){

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Add User"]
          ];
          return view('/content/user/add-user',[
            'breadcrumbs' => $breadcrumbs,

          ]);
    }

    public function createUsers(Request $request){

      $users = new User();
      $users->name = $request->name;
      $users->email  = $request->email;
      $users->email_verified_at = $request->email_verified_at;
      $users->password = Hash::make($request->password);
      $users->role = $request->role;
      // $users->status = 1;
    
      $users->save();
  
      return redirect()->back()->with('success', 'Users added successfully !!!');
 
  }
    public function editUsers($id){

      $users = User::find($id);
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Edit User"]
          ];
          return view('/content/user/edit-user',[
            'breadcrumbs' => $breadcrumbs,
            'users' =>$users
          ]);
    }


    public function updateUsers(Request $request)
    {
      
      $users = User::find($request->id);
      $users->name = $request->name;
      $users->email = $request->email;
      $users->role = $request->role;

      if(!empty($request->input('password'))) {
        $users->password = Hash::make($request->password);
      }
      else {
        unset($request->password);
      }
      
      $users->update();

    return redirect()->back()->with('success', 'Updated successfully !!! ');

    }
    public function deleteUsers($id)
    {
      $users = User::find($id);

      $users->delete();

      return redirect()->back()->with('success', 'Deleted successfully.');
                     
    }
}

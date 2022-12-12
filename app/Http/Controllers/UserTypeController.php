<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;

class UserTypeController extends Controller
{
    //

    public function index()
    {
        $usertype = UserType::all();
        //dd($usertype);
        return view('admin.usertype.usertype', compact('usertype'));
    }



    public function UsertypeView($id){

    	$usertype = DB::table('user_types')
    			->select('user_types.*',)
    			->where('user_types.id',$id)
    			->first();



    	return view('admin.usertype.show',compact('usertype'));

    }


    public function storeUsertype(Request $request)
    {
        // $validateData = $request->validate ([

        // 'name' => 'required|max:255',

        // ]);


         $usertype = new UserType();
         $usertype->name = $request->name;
         $usertype->save();

        $notification=array(
                                            'message'=>'Usertype added successfully',
                                            'alert-type'=>'success'
                                            );
                                        return Redirect()->back()->with($notification);


    }


    public function DeleteUsertype($id)
    {
        DB::table('user_types')->where('id' , $id)->delete();

        $notification=array(
                                'message'=>'User Type deleted successfully',
                                'alert-type'=>'success'
                                );
            return Redirect()->back()->with($notification);
    }

    public function EditUsertype($id)
    {
        $usertype = DB::table('user_types')->where('id', $id )->first();
        return view('admin.usertype.edit', compact('usertype'));

    }
    public function UpdateUsertype(Request $request, $id)
    {

        $data['name'] = $request->name;

        $update = DB::table('user_types')->where('id' , $id)->update($data);

        if ($update) {
            $notification=array(
                'message'=>'Usertype Successfully Updated',
                'alert-type'=>'success'
                  );
              return Redirect()->route('usertypes')->with($notification);
        }else {
            $notification=array(
                'message'=>'Nothing To Update',
                'alert-type'=>'success'
                  );
              return Redirect()->route('usertypes')->with($notification);
        }

}
}

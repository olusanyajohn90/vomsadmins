<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use DB;


class StateController extends Controller
{
    public function index()
    {
        $state = State::all();
        //dd($usertype);
        return view('admin.state.all', compact('state'));
    }



    public function stateView($id){

    	$statee = DB::table('states')
    			->select('states.*',)
    			->where('states.id',$id)
    			->first();

// dd($statee);

    	 return view('admin.state.show',compact('statee'));

    }


    public function storeState(Request $request)
    {
        // $validateData = $request->validate ([

        // 'name' => 'required|max:255',

        // ]);


         $state = new State();
      //   $state->state_id = $request->state_id;
         $state->name = $request->name;
         $state->save();

        $notification=array(
                                            'message'=>'State added successfully',
                                            'alert-type'=>'success'
                                            );
                                        return Redirect()->back()->with($notification);


    }


    public function DeleteState($id)
    {
        DB::table('states')->where('id' , $id)->delete();

        $notification=array(
                                'message'=>'State deleted successfully',
                                'alert-type'=>'success'
                                );
            return Redirect()->back()->with($notification);
    }

    public function EditState($id)
    {
        $state = DB::table('states')->where('state.id', $id )->first();
        return view('admin.state.edit', compact('state'));

    }
    public function UpdateState(Request $request, $id)
    {
        $data = array();
       // $data['state_id'] = $request->state_id;
        $data['name'] = $request->name;
      //  $data->save();

        $update = DB::table('states')->where('id' , $id)->update($data);

        if ($update) {
            $notification=array(
                'message'=>'State Successfully Updated',
                'alert-type'=>'success'
                  );
              return Redirect()->route('states')->with($notification);
        }else {
            $notification=array(
                'message'=>'Nothing To Update',
                'alert-type'=>'success'
                  );
              return Redirect()->route('states')->with($notification);
        }

}

}

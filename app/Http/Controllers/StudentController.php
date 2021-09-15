<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    /*------------------------------------------------------------------------
    | View all students and also a specific students information.Question No.2
    --------------------------------------------------------------------------*/

    public function index($id = null){

        if($id){
            $students = User::find($id);
            return json_encode($students);
        }
        else{
            $students = User::get();
            return json_encode($students);
        }


    }

    /*------------------------------------------------------------------------
    | Update Or Modify student's information.Question No.3
    --------------------------------------------------------------------------*/

    public function update(Request $request){
        $id = auth()->user()->id;
        $update = User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);



        if($update){
            return json_encode('Student updated.');
        }
        else{
            return json_encode('Student is not updated.');
        }
    }
}

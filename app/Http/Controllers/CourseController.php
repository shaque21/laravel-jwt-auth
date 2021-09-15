<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{

    /*------------------------------------------------------------------------
    | View All Courses.Question No.5
    --------------------------------------------------------------------------*/

    public function index(){

        $courses = Course::get();
        return response()->json([
            'message' => 'All Courses',
            'courses' => $courses
        ]);

    }

    /*------------------------------------------------------------------------
    | Create a course .Question No.4
    --------------------------------------------------------------------------*/

    public function create(Request $request){
        json_decode($request->course_name);
        $insert = Course::insert([
            'course_name' => $request->course_name,
        ]);


        if($insert){
            return json_encode('Course saved.');
        }
        else{
            return json_encode('Course is not saved.');
        }
    }

    public function delete($id){
        $delete = Course::where('id',$id)->delete();
        if($delete){
            return response()->json([
                'message' => 'Course deleted.'
            ]);
        }
        else{
            return response()->json([
                'message' => 'Course is not deleted.'
            ]);
        }

    }

}

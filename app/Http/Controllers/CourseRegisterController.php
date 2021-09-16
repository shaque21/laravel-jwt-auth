<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseRegister;
use App\Models\Course;
use App\Models\User;
use DB;

class CourseRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    /*------------------------------------------------------------------------
    | One or More Course registration for a student .Question No.6
    --------------------------------------------------------------------------*/

    public function create(Request $request){
        json_decode($request->course_id);
        $student_id = auth()->user()->id;

        $courses = Course::get();
        foreach($courses as $course){
            if($course->id != $request->course_id){
                $insert = CourseRegister::insert([
                    'course_id' => $request->course_id,
                    'student_id' => $student_id,
                ]);
                if($insert){
                    return response()->json([
                        'message' => 'Course Registration Complete.',
                        'Registered Course' => $insert
                    ]);
                }
                else{
                    return json_encode('Something Went Wrong');
                }
                break;
            }
            else{
                return json_encode('This course already taken');
            }
        }
    }

    /*------------------------------------------------------------------------
    | Drop a course for a specific student.Question No.7
    --------------------------------------------------------------------------*/

    public function drop($id){

        $student_id = auth()->user()->id;
        $drop_course = CourseRegister::where('course_id',$id)
            ->where('student_id',$student_id)->delete();

        if($drop_course){
            return response()->json([
                'message' => 'Course droped.'
            ]);
        }
        else{
            return response()->json([
                'message' => 'Something Went Wrong.'
            ]);
        }

    }

    /*------------------------------------------------------------------------
    | View all courses for a specific student.Question No.8
    --------------------------------------------------------------------------*/

    public function student_course(){

        $student_id = auth()->user()->id;
       

        $reg_course = DB::table('course_registers')
                     ->join('courses','course_registers.course_id','courses.id')
                     ->join('users','course_registers.student_id','users.id')
                     ->where('course_registers.student_id',$student_id)
                     ->get();
        
        foreach($res_course as $value){
            $student_name = $value->name;
        }


        return response()->json([
            'Student ID' => $student_id,
            'Student Name' => $student_name,
            'Registered Courses are' => $reg_course
        ]);

    }

}

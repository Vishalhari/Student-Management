<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

use App\model\Teacher;
use App\model\Student;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['students'] = Student::select('id','student_name','student_age','student_gender','teacherId')
                            ->with([
                            'teacherselect' => function($query){
                                $query->select('id','teacher_name');
                            },
                            ])
                            ->paginate(10); 
        return view('student/student',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit'] = 0;
        $data['teachers'] = Teacher::all();
         return view('student/addedit_student',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                    'fullname'=>'required',
                    'age'=>'required',
                    'genderselection'  =>'required',
                    'teacherid'  =>'required',
             ]);
             if ($validator -> fails()) {
                return back()->withErrors($validator)->withInput();
             } else {
                $objstudent                     = new Student(); 
                $objstudent->student_name       = $request->fullname; 
                $objstudent->student_age        = $request->age; 
                $objstudent->student_gender     = $request->genderselection; 
                $objstudent->teacherId          = $request->teacherid;  
                $objstudent->save(); 

                 Session::flash('message', 'Student Created Successfully!');
                return redirect('students/create');
             }
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['teachers'] = Teacher::all();
        $data['students'] = Student::select('id','student_name','student_age','student_gender','teacherId')
                            ->where('id',$id)
                            ->first();
        $data['edit'] = 1;
        return view('student/addedit_student',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                    'fullname'=>'required',
                    'age'=>'required',
                    'genderselection'  =>'required',
                    'teacherid'  =>'required',
             ]);
             if ($validator -> fails()) {
                return back()->withErrors($validator)->withInput();
             } else {
                $objstudent                     = Student::find($id); 
                $objstudent->student_name       = $request->fullname; 
                $objstudent->student_age        = $request->age; 
                $objstudent->student_gender     = $request->genderselection; 
                $objstudent->teacherId          = $request->teacherid;  
                $objstudent->save(); 

                 Session::flash('message', 'Student Successfully Updated!');
                return redirect('students');
             }
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::where('id', '=',$id)->delete();
        return response()->json([
            'message' => 'success'
        ]);
    }
}

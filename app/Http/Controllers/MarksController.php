<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

use App\model\Student;
use App\model\Marks;
use App\model\Terms;

class MarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['marks'] = Marks::select('id','studentId','termId','maths_mark','science_mark','history_mark','created_at')
                         ->with([
                            'studentselect' => function($query1){
                                $query1->select('id','student_name');
                            },
                            'termselect' => function($query2){
                                $query2->select('id','terms');
                            }
                         ])
                         ->paginate(10);
        return view('marks/marks',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['edit'] = 0;
         $data['students'] = Student::all();
         $data['terms'] = Terms::all();
         return view('marks/addedit_marks',$data);
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
                    'studentsid'=>'required',
                    'termid'=>'required',
                    'mat_mark'  =>'required',
                    'sci_mark'  =>'required',
                    'his_mark'  =>'required',
             ]);
             if ($validator -> fails()) {
                 return back()->withErrors($validator)->withInput();
             } else {
                $objstudmark                     = new Marks(); 
                $objstudmark->studentId          = $request->studentsid; 
                $objstudmark->termId             = $request->termid; 
                $objstudmark->maths_mark         = $request->mat_mark; 
                $objstudmark->science_mark       = $request->sci_mark;  
                $objstudmark->history_mark       = $request->his_mark;  
                $objstudmark->save();
                Session::flash('message', 'Student Marks Created Successfully!');
                return redirect('studentmarks/create');
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
         $data['edit'] = 1;
         $data['students'] = Student::all();
         $data['terms'] = Terms::all();
         $data['mark'] = Marks::select('id','studentId','termId','maths_mark','science_mark','history_mark')
                         ->where('id',$id)
                        ->first();
         return view('marks/addedit_marks',$data);
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
                    'studentsid'=>'required',
                    'termid'=>'required',
                    'mat_mark'  =>'required',
                    'sci_mark'  =>'required',
                    'his_mark'  =>'required',
             ]);
             if ($validator -> fails()) {
                 return back()->withErrors($validator)->withInput();
             } else {
                $objstudmark                     = Marks::find($id); 
                $objstudmark->studentId          = $request->studentsid; 
                $objstudmark->termId             = $request->termid; 
                $objstudmark->maths_mark         = $request->mat_mark; 
                $objstudmark->science_mark       = $request->sci_mark;  
                $objstudmark->history_mark       = $request->his_mark;  
                $objstudmark->save();
                Session::flash('message', 'Student Marks Successfully Updated!');
                return redirect('studentmarks');
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
        Marks::where('id', '=',$id)->delete();
        return response()->json([
            'message' => 'success'
        ]);
    }
}

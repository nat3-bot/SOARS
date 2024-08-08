<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use Datatables;

class CoursesController extends Controller
{
    public function courselist()
    {
        if(request()->ajax()) {
            return datatables()->of(Courses::select('*'))
            ->addColumn('action', 'course-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('course-list');
    }

    public function stores(Request $request)
    {
        $courseId = $request->id;

        $course = Courses::updateOrCreate(
            [
                'id' => $courseId,
            ],
            [
                'course_name' => $request->course_name,
            ]);
        return Response()->json($course);
    }

    public function edits(Request $request)
    {
        $where = array('id' => $request->id);
        $course = Courses::where($where)->first();

         return Response()->json($course);
    }

    public function deletes(Request $request)
    {
        $course= Courses::where('id',$request->id)->delete();

        return Response()->json($course);

    }
}

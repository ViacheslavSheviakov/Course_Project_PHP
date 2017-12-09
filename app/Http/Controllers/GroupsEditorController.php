<?php
/**
 * Created by PhpStorm.
 * User: Vladimir
 * Date: 11.11.2017
 * Time: 16:57
 */

namespace App\Http\Controllers;


use App\Group;
use App\Student;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class GroupsEditorController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view('groups.index')->with('groups', $groups);
    }

    public function group($id)
    {
        $groups = Group::all();
        $students = Student::
            where('GroupShortTitle', $id)
            ->get();
        return view('groups.group')->with(['students'=> $students, 'groups'=>$groups]);
    }

    public function add()
    {
        return view('groups.add');
    }

    public function groupAdd(Request $request)
    {
        $group = new Group();
        $group->GroupShortTitle = $request->GroupShortTitle;
        $group->GroupFullTitle = $request->GroupFullTitle;
        Group::insert(
            array('GroupShortTitle' => $group->GroupShortTitle,
                'GroupFullTitle'  => $group->GroupFullTitle)
        );
        return "Done";
    }

    public function ajaxgroup(Request $request)
    {
        if ($request->ajax()) {
            $recordBookId = $request->input('RecordBookId');
            $groupShortTitle = $request->input('val');
            Student::where('RecordBookId', $recordBookId)
                ->update(['GroupShortTitle' => $groupShortTitle]);
            return "Done";
        }
    }
}
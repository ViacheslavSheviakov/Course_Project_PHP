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
use App\Professor;
use Illuminate\Http\Request;

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
        if ($students->isEmpty()) {
            return $view = view('groups.delete')->with( 'id', $id);
        }
        $view = view('groups.group')->with(['students'=> $students, 'groups'=>$groups]);

        return $view;
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
        $group->ProfessorId = $request->ProfessorId;
        Group::insert(
            array('GroupShortTitle' => $group->GroupShortTitle,
                'GroupFullTitle'  => $group->GroupFullTitle,
                'CuratorId' => $group->ProfessorId)
        );
        return app('App\Http\Controllers\GroupsEditorController')->index();
    }

    public function addTeacherToGroup(Request $request)
    {
        $teachers = Professor::all();
        $teachers->GroupShortTitle = $request->GroupShortTitle;
        $teachers->GroupFullTitle = $request->GroupFullTitle;
        return view('groups.addTeacherToGroup')->with('teachers', $teachers);
    }

    public function deleteGroup($id)
    {
        Group::where('GroupShortTitle', '=', $id)->delete();
        return  app('App\Http\Controllers\GroupsEditorController')->index();
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
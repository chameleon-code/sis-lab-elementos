<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Management;
use App\SubjectMatter;
use Illuminate\Support\Facades\Session;
use App\Group;
use App\User;
use App\Professor;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::getAllGroups();
        $data=['groups' => $groups,
                'title' => 'Grupos'];
        return view('components.contents.groups.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectMatters = SubjectMatter::getAllSubjectMatters();
        $managements = Management::getAllManagements()->reverse();
        $professors = Professor::getAllProfessors();
        $count = $this->getCountSubjects(new Request(), 1) + 1;
        $groupNames = array();
        for($i = 1; $i<10; $i++){
            if(!in_array($i ,$this->getGroupsNameBySubjects(1))){
                array_push($groupNames, $i);
            }
        }
        $data=['subjectMatters'=>$subjectMatters,
                'managements' =>$managements,
                'professors' => $professors,
                'countGroups' => "Grupo " . $count,
                'groupNames' => $groupNames
            ];
        return view('components.contents.groups.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input =$request->all();
        $groups = new Group();
        if($groups->validate($input)){
            Group::create($input);
            Session::flash('status_message','Grupo añadido!');
            
            return redirect('/admin/groups');
        }
            return redirect('/admin/groups/create')->withInput()->withErrors($groups->errors);
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
        $group = Group::findOrFail($id);
        $subject_matter_id=$group->subject_matters_id;
        $subjectMatters = SubjectMatter::getAllSubjectMatters();
        $managements = Management::getAllManagements();
        $professors = Professor::getAllProfessors();
        
        $data=['group' => $group,
            'subject_matter_id' => $subject_matter_id,
            'subjectMatters' => $subjectMatters,
            'managements' => $managements,
            'professors' => $professors
        ];
        
        return view('components.contents.groups.edit')->withTitle('Editar la Materia')->with($data);
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
        $group = Group::find($id);
        $input = $request->all();

        if($group->validate($input)){
            $group->name = $request->name;
            $group->subject_matter_id = $request->subject_matter_id;
            $group->management_id = $request->management_id;
            $group->professor_id = $request->professor_id;
            $group->save();

            Session::flash('status_message', 'Grupo Editado!');
            return redirect('/admin/groups');
        }
        return back()->withInput($input)->withErrors($group->errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $group = Group::findOrFail($id);

            $group->delete();
            $status_message = 'Grupo borrado';
        }catch(ModelNotFoundException $e){
            $status_message = 'Grupo no identificado';
        }

        Session::flash('status_message',$status_message);
        return redirect('/admin/groups');
        }
        public function getCountSubjects(Request $request, $id){
            $count = Group::where('subject_matter_id', $id)->count();
            if($request->ajax()){
                return response()->json($count);
            }
            return $count;
        }
        public function getGroupsNameBySubjects($id){
            $groups = Group::getGroupsBySubjects($id);
            $groups = array_pluck($groups, 'name');
            $names = array();
            foreach($groups as $group){
                $names = array_prepend($names, substr($group, -1));
            }
            return $names;
        }
        //deprecated
        /*public function getProfessors(Request $request, $id){
            if($request->ajax()){
                $professors = ProfessorSubjectMatter::getAllProfessors($id);
                $users = array();
                $i = 0;
                foreach($professors as $key=>$value){
                    $usr = Professor::where('id', $value->professor_id)->firstOrFail();
                    $user = User::findOrFail($usr->user_id);
                    $users[$i] = $user;
                    $i++;
                }
                return response()->json($users);
            }
        }*/
}

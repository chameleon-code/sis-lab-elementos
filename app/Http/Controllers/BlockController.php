<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubjectMatter;
use App\Group;
use App\Block;
use App\BlockGroup;
use App\Management;
use Illuminate\Support\Facades\Storage;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = Block::getAllBlocks();
        $data = [
            'blocks' => $blocks
        ];
        return view('components.contents.blocks.index', $data);
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
        $groupsID = BlockGroup::getAllBlockGroupsId();
        $groups = Group::where('subject_matter_id', 1)
                        ->whereNotIn('id', $groupsID)                        
                        ->orderBy('name')->get();
        $data=['subjectMatters'=>$subjectMatters,
                'groups'=>$groups,
                'managements' =>$managements,
            ];
        return view('components.contents.blocks.create', $data);
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
        $block = new Block();
        $man = Management::find($request->management_id);
        $dir = $man->management_path.'/'.$request->name;

        if($block->validate($input)){
            $block->management_id = $request->management_id;
            $block->name = $request->name;
            $block->block_path = $dir;
            $groupsID = $request->groups_id;
            $block->save();

            Storage::makeDirectory($dir);

            foreach($groupsID as $key=>$value){
                $group = Group::where('id', $value)->first();
                $block->groups()->attach($group->id);
            }
            return redirect('/admin/blocks');
        }
        else{
            return redirect('/admin/blocks/create')->withInput()->withErrors($block->errors);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getGroups(Request $request, $id){
        $groups = Group::getGroupsBySubjects($id);
        if($request->ajax()){
            return response()->json($groups);
        }
        return $groups;
    }
}

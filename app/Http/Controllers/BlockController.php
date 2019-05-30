<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubjectMatter;
use App\Group;
use App\Block;
use App\BlockGroup;
use App\Management;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::rememberNav();

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
        self::rememberNav();

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
        //dd($request->groups_id);
        $input =$request->all();
        $block = new Block();
        $man = Management::find($request->management_id);
        $name = 'Bloque-';
        if($block->validate($input)){   
            $man = Management::find($request->management_id);
            $dir = $man->management_path.'/'.$request->name;
            $block->management_id = $request->management_id;
            $block->name = $name;
            $groupsID = $request->groups_id;
            $block->save();
            foreach($groupsID as $key=>$value){
                $group = Group::where('id', $value)->first();
                $block->groups()->attach($group->id);
                //$name .= '-'.$group->professor->first_name[0];
            }
            $name .= $block->id;
            $dir = $man->management_path.'/'.$name;
            $block->block_path = $dir;
            $block->name = $name;
            $block->save();
            Storage::makeDirectory($dir);
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
        self::rememberNav();
        $block = Block::findOrFail($id);
        //dd($block->groups->first()->subject->id);
        $subjectMatters = SubjectMatter::getAllSubjectMatters();
        $managements = Management::getAllManagements()->reverse();
        $groupsID = BlockGroup::getAllBlockGroupsId();
        $groups = Group::where('subject_matter_id', $block->groups->first()->subject->id)
                        ->whereNotIn('id', $groupsID)                        
                        ->orderBy('name')->get();
        $data=['subjectMatters'=>$subjectMatters,
                'groups'=>$groups->merge($block->groups),
                'managements' =>$managements,
                'block' => $block
            ];
        return view('components.contents.blocks.edit', $data);
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
        $input =$request->all();
        $block = Block::findOrFail($id);
        $name = 'Bloque';
        if($block->validate($input)){   
            // Pedir ayuda a Abel
            //$man = Management::find($request->management_id);
            //$dir = $man->management_path.'/'.$request->name;
            $block->management_id = $request->management_id;
            $block->name = $name;
            $groupsID = $request->groups_id;
            $block->groups()->detach($block->groups->pluck('id')->toArray());
            foreach($groupsID as $key=>$value){
                $group = Group::where('id', $value)->first();
                $block->groups()->attach($group->id);
                $name .= '-'.$group->professor->first_name[0];
                //$name .= '-'.$block->id;
            }

            //$dir = $man->management_path.'/'.$name;

            //$block->block_path = $dir;
            $block->name = $name;
            $block->save();
            //Storage::makeDirectory($dir);
            return redirect('/admin/blocks');
        }
        else{
            return back()->withInput()->withErrors($block->errors);
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
        //
    }
    public function getGroups(Request $request, $id){
        $groups = Group::getGroupsBySubjects($id);
        $groupsBlocks = BlockGroup::getAllBlockGroupsId();
        //dd($groupsBlocks);
        $groups2 = $groups->reject(function($item, $key) use ($groupsBlocks){
            if (in_array($item->id, $groupsBlocks) && !$item->available)
                return true;
        });
        if($request->ajax()){
            return response()->json($groups2->values()->all());
        }
        return $groups2->values()->all();
    }
    public function getBlocksBySubjects(Request $request, $id){
        $blocks = Block::getAllBlocks();
        $blocks2 = $blocks->reject(function($item, $key) use ($id){
            if($item->groups->first()->subject_matter_id != $id)
                return true; 
            });
            if($request->ajax()){
                return response()->json($blocks2->values()->all());
            }
            return $blocks2->values()->all();       
    }
    public function getGroupsByBlocks(Request $request, $id){
        $block = Block::findOrFail($id);
        if($request->ajax()){
            return response()->json($block->groups);
        }
        return $block->groups;
    }

    public function rememberNav(){
        $tmp = 0.05;
        Cache::put('professor_nav', '', $tmp);
        Cache::put('auxiliar_nav', '', $tmp);
        Cache::put('student_nav', '', $tmp);
        Cache::put('management_nav', '', $tmp);
        Cache::put('subject_matter_nav', '', $tmp);
        Cache::put('group_nav', '', $tmp);
        Cache::put('block_nav', ' show', $tmp);
    }
}

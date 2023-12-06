<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Tecnology;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id')->paginate(10);
        Paginator::useBootstrapFive();
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $title = 'Inserimento nuovo progetto';
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.projects.create', compact('title','types','project','tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data= $request->all();
        $new_project = new Project;
        //dd($form_data);
        $new_project['slug']= Project::generateSlug($form_data['name']);
        $new_project->type_id = $form_data['type_id'];
        $new_project->fill($form_data);
        $new_project->save();
        if(array_key_exists('tecnologies', $form_data)){
            $new_project->tecnologies()->attach($form_data['tecnologies']);
        }

        return redirect()->route('admin.projects.show', $new_project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $title ='Modifica i singoli elementi';
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.projects.edit', compact('project', 'title','types', 'tecnologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data= $request->all();

        if($form_data['name'] != $project->name){
            $form_data['slug'] = $project->slug;
        }else{
            $form_data['slug'] = Project::generateSlug($form_data['name']);
        }

        $project->type_id = $form_data['type_id'];

        //cerco la chiave
        if(array_key_exists('tecnologies', $form_data)){
            $project->tecnologies()->sync($form_data['tecnologies']);
        }
        $project->update();


        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with("success", "Hai eliminato il progetto con successo");
    }
}

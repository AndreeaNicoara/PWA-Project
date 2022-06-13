<?php

namespace App\Http\Controllers\system\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator,Redirect,Response;
use View;
use App\Models\UsersModel;
use App\Models\ProjectsModel;
use App\Models\ProjectUsersModel;
use App\Models\ProjectMembersModel;
use App\Models\ProjectTasksModel;
use App\Models\ApiTemplatesItemsModel;
use App\Models\ProjectRolesModel;
use App\Models\ProjectTechnologiesModel;
use Session;

class RoleController extends Controller
{
    //Role Management
    public function index(Request $request){

        $ProjectTasksModel = new ProjectTasksModel();//Load model
        $ProjectRolesModel = new ProjectRolesModel();//Load model
        $UsersModel = new UsersModel();//Load model

        $user_id = auth()->user()->id;

        $username = auth()->user()->first_name.' '.auth()->user()->last_name;

        // $role_projects = $ProjectRolesModel->get_all_assign_role_project_by_user_id($user_id);//Get all leader projects

        $role_projects = ProjectRolesModel::select('*')
        ->leftJoin('users', 'users.id', '=', 'project_roles.member_id')
        ->leftJoin('projects', 'projects.project_id', '=', 'project_roles.project_id')
        ->where("project_roles.member_id",$user_id)
        ->orderBy("projects.project_id", "desc")
        // ->groupBy("project_roles.project_id")
        ->with([
            'tasks'
        ])
        ->get();
        
        $data['page_title'] = 'Roles';
        $data['role_projects'] = $role_projects;
        $data['ProjectTasksModel'] = $ProjectTasksModel;
        $data['UsersModel'] = $UsersModel;
        $data['username'] = $username;

        return response()->json($data, 200);
        
    }

    //View role ajax view
    public function viewRoleFormAjax(Request $request)
    {
        $UsersModel = new UsersModel();
        $ProjectRolesModel = new ProjectRolesModel();

        $project_id   = $request->get('project_id');
        $user_id   = auth()->user()->id;

        $role_projects = $ProjectRolesModel->get_all_assign_roles_by_project_id_and_user_id($project_id,$user_id);//Get all leader projects

        $data['role_projects'] = $role_projects;

        return response()->json($data, 200);
         

        // return Response::json(array('element' => View::make('system/role/view_role_form_aj',$data)->render()));
    }

}

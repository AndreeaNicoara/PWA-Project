<?php

namespace App\Http\Controllers\system\task;

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


class TaskController extends Controller
{
    public function index(Request $request){

        $ProjectTasksModel = new ProjectTasksModel();
        $UsersModel = new UsersModel();

        $user_id = auth()->user()->id;

        $tasks = $ProjectTasksModel->get_all_tasks_by_user_id($user_id);
        
        $data['page_title'] = 'Tasks';
        $data['tasks'] = $tasks;
        $data['UsersModel'] = $UsersModel;

        return response()->json($data, 200);
        
    }

    

    public function editTaskFormAjax(Request $request)
    {
        $project_task_id = $request->get('project_task_id');
        $user_id = auth()->user()->id;

        
        $ProjectTasksModel = new ProjectTasksModel();
        $ProjectUsersModel = new ProjectUsersModel();

        $task = $ProjectTasksModel->get_task_by_project_task_id($project_task_id);

        $data['task'] = $task;

        return response()->json($data, 200);

        // return Response::json(array('element' => View::make('system/task/edit_task_form_aj',$data)->render()));
    }


    public function updateTaskProcess(Request $request)
    {
        $ProjectTasksModel = new ProjectTasksModel();
        
        $user_id = auth()->user()->id;

        $project_task_id= $request->get('project_task_id');
        $task_status= $request->get('task_status');

        $validator = Validator::make($request->all(), [
            'project_task_id' => 'required',
            'task_status' => 'required',
        ],
        [
            'project_task_id.required' => 'Project is required',
            'task_status.required' => 'Status is required',
            
        ]);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{

            $updated = $ProjectTasksModel::where('project_task_id', $project_task_id)->update(
                array(
                    'project_task_id'   => $project_task_id,
                    'task_status'   => $task_status,
                    'updated_by'   => auth()->user()->id,
                    'updated_date'   => date("Y-m-d H:i:s"),
                )
            );
            

            if($updated){
                $response = array(
                    'status' => true,
                    'message' => "Task updated successfully."
                );
            }else{
                $response = array(
                    'status' => false,
                    'message' => "Something went wrong."
                );
            }

            return response()->json($response, 200);
        }
    }


    
}

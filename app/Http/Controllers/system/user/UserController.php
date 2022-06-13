<?php

namespace App\Http\Controllers\system\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Validator,Redirect,Response;
use View;
use App\Models\UsersModel;
use Session;


class UserController extends Controller
{
    //User Management
    public function index(Request $request){

        $users = UsersModel::all();//Get all users
        
        $data['page_title'] = 'Users';//Define page title
        $data['users'] = $users;//Pass users data to $data array

        return response()->json($data, 200);
        
    }

    //Add user ajax view
    public function addUserFormAjax(Request $request)
    {
        return Response::json(array('element' => View::make('system/user/add_user_form_aj')->render()));
    }

    //Add user process
    public function addUserProcess(Request $request)
    {
        $UsersModel = new UsersModel();//Load model

        //Assign data to variable
        $first_name= $request->get('first_name');
        $last_name= $request->get('last_name');
        $user_type= $request->get('user_type');
        $username= $request->get('username');
        $password= $request->get('password');
        $status= $request->get('status');

        //Input validations
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2|max:50',//Validation rule
            'last_name' => 'required|min:2|max:50',//Validation rule
            'user_type' => 'required',//Validation rule
            'username' => 'required|min:5|max:50',//Validation rule
            'password' => 'required|min:5|max:50',//Validation rule
            'status' => 'required',//Validation rule
        ],
        [
            'first_name.required' => 'First name is required',//Validation message
            'first_name.min' => 'Fist name must be at least 2 characters',//Validation message
            'first_name.max' => 'First name cannot exceed 50 characters',//Validation message
            'last_name.required' => 'Last name is required',//Validation message
            'last_name.min' => 'Last name must be at least 2 characters',//Validation message
            'last_name.max' => 'Last name cannot exceed 50 characters',//Validation message
            'user_type.required' => 'User type is required',//Validation message
            'login.required' => 'Username is required',//Validation message
            'login.min' => 'Username must be at least 5 characters',//Validation message
            'login.max' => 'Username cannot exceed 50 characters',//Validation message
            'password.required' => 'Password is required',//Validation message
            'password.min' => 'Password must be at least 5 characters',//Validation message
            'password.max' => 'Password cannot exceed 50 characters',//Validation message
            'status.required' => 'Status is required',//Validation message
            
        ]);

        if ($validator->fails()) {//If validation fails
            //Failure response message
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{//If validation succeeds

            //Assign all data to model
            $UsersModel->first_name = $first_name;
            $UsersModel->last_name = $last_name;
            $UsersModel->user_type = $user_type;
            $UsersModel->username = $username;
            $UsersModel->password = bcrypt($password);
            $UsersModel->confirmation_code = $password;
            $UsersModel->status = $status;
            $UsersModel->added_by = auth()->user()->id;
            $UsersModel->added_date = date("Y-m-d H:i:s");

            $added=$UsersModel->save();

            if($added){
                //Success response message
                return response()->json("User added successfully.", 200);
               
            }else{
                //Failure response message
                return response() -> json('Something went wrong');
            }

            return response()->json($response, 200);
        }
    }

    //Edit user 
    public function editUserForm(Request $request)
    {
        $user_id = $request->get('user_id');//Assign user ID to variable

        $UsersModel = new UsersModel;//Load model

        $user = $UsersModel->get_user_by_user_id($user_id);//Get user details by user id

        $data['user'] = $user;//Pass user data to the $data array

        return response()->json($data, 200);
    }

    //Edit user process
    public function updateUserProcess(Request $request)
    {
        $UsersModel = new UsersModel();//Load Model

        //Assign data to variable
        $user_id= $request->get('user_id');
        $first_name= $request->get('first_name');
        $last_name= $request->get('last_name');
        $user_type= $request->get('user_type');
        $username= $request->get('username');
        $password= $request->get('password');
        $status= $request->get('status');

        //Input validations
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2|max:50',//Validation rule
            'last_name' => 'required|min:2|max:50',//Validation rule
            'user_type' => 'required',//Validation rule
            'username' => 'required|min:5|max:50',//Validation rule
            'password' => 'required|min:5|max:50',//Validation rule
            'status' => 'required',//Validation rule
        ],
        [
            'first_name.required' => 'First name is required',//Validation message
            'first_name.min' => 'Fist name must be at least 2 characters',//Validation message
            'first_name.max' => 'First name cannot exceed 50 characters',//Validation message
            'last_name.required' => 'Last name is required',//Validation message
            'last_name.min' => 'Last name must be at least 2 characters',//Validation message
            'last_name.max' => 'Last name cannot exceed 50 characters',//Validation message
            'user_type.required' => 'User type is required',//Validation message
            'login.required' => 'Username is required',//Validation message
            'login.min' => 'Username must be at least 5 characters',//Validation message
            'login.max' => 'Username cannot exceed 50 characters',//Validation message
            'password.required' => 'Password is required',//Validation message
            'password.min' => 'Password must be at least 5 characters',//Validation message
            'password.max' => 'Password cannot exceed 50 characters',//Validation message
            'status.required' => 'Status is required',//Validation message
            
        ]);

        if ($validator->fails()) {//If validation fails
            //Failure response message
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{//If validation succeeds

            //Update data
            $updated = $UsersModel::where('id', $user_id)->update(
                array(
                    'first_name'   => $first_name,
                    'last_name'   => $last_name,
                    'user_type'   => $user_type,
                    'username'   => $username,
                    'password'   => bcrypt($password),
                    'confirmation_code'   => $password,
                    'status'   => $status,
                    'updated_by'   => auth()->user()->id,
                    'updated_date'   => date("Y-m-d H:i:s"),
                )
            );
            

            if($updated){
                //Success response message
                return response()->json("User updated successfully.", 200);
            }else{
                //Failure response message  
                return response() -> json('Something went wrong.');
            }

            return response()->json($response, 200);
        }
    }

    //Delete user process
    public function deleteUserProcess(Request $request)
    {
        $UsersModel = new UsersModel();
        

        $user_id= $request->get('user_id');

        //Delete data
        $deleted = $UsersModel::where('id', $user_id)->delete();
            

        if($deleted){
            //Success response message
            return response()->json("User deleted successfully.", 200);
           
        }else{
            //Failure response message  
            return response() -> json('Something went wrong.');
        }

        return response()->json("User deleted successfully.", 200);
    }
}

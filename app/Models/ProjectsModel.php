<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ProjectsModel extends Model
{
    protected $table = 'projects';
    protected $allowedFields = ['project_id','project_name','start_date','end_date','project_manager_id','status'];
    public $timestamps = false;

    function get_project_by_project_id($project_id){
        return DB::table('projects')->select("*")->where('project_id', $project_id)->first();

    }

    public function user()
	{
		return $this->hasOne('App\Models\UsersModel','id','user_id');
    }

    public function tasks()
	{
		return $this->hasMany('App\Models\ProjectTasksModel','project_id','project_id');
    }
}

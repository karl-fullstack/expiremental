<?php

namespace App\Http\Controllers\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Task;
use App\Http\Controllers\Controller;
// use App\Events\TaskCreated;
// use App\Events\TaskRemoved;

class TaskController extends Controller
{
    /**
     * Fetch all Task in the Database
     * 
     * @param [] 
     * @return DB - List of all task in the database
     */
    public function index() 
    {
        return DB::table('tasks')
        ->orderby('priority_rate', 'DESC')
        ->get();
         
    }

    /**
     * Show single task
     * 
     * @param [int] $id - ID to be displayed
     * @return DB - List of tasks where the given param is the id
     */
    public function show($id) 
    {
        $task = DB::table('tasks')
        ->where('id', $id)        
        ->first();             
        
        return $task;
    }

    /**
     * Store task
     * 
     * @param [Request] $request - datas that was sent
     * @return [string] json - return "Stored"
     */
    public function store(Request $request) 
    {
        
        
        // $task = Task::create($request->all());
        $task = new Task;
        $task->title = $request->title;
        $task->status = 'Queued';
        $task->priority_rate = $request->priority_rate;
        $task->save();
        
        return response()->json('Stored');
    }

    /**
     * Store task
     * 
     * @param [int] $id - datas that was sent
     * @param [Request] $request - datas that was sent
     * @return [string] json - return "Stored"
     */
    public function update(int $id, Request $request) 
    {
        $task = Task::find($id);

        $task->title = $request->title;
        $task->status = 'Queued';
        $task->priority_rate = $request->priority_rate;
        $task->save();

        return response()->json('Updated');
    }

    /**
     * Store task
     * 
     * @param [int] $id - Id that will be used to find the specific task to delete
     * @return [string] json - return "Stored"
     */
    public function destroy($id) 
    {
        // broadcast(new TaskRemoved($task));
        $delete_this = DB::table('tasks')
        ->where('id', $id)
        ->delete();
        return response()->json('Deleted');
    }
}

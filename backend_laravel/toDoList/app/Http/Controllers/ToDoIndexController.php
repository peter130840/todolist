<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ToDoLists;
use App\Users;

header("Content-Type:text/html; charset=utf-8");
header('Content-type: application/json');
 //axios 解決跨域問題
header("Access-Control-Allow-Credentials: true");  // 相對應 axios 的設定，若有使用cookie、session則要開啟, 否則瀏覽器不會將response返回  
header("Access-Control-Allow-Origin: *");  // 指定可允許訪問的URL  
header("Access-Control-Allow-Methods: POST, GET, OPTIONS,PUT,DELETE"); // 允許客戶端可使用的方式  
header("Access-Control-Allow-Headers: X-PINGOTHER, Content-Type, X-Requested-With"); // 服務器允許請求中攜帶字段 

class ToDoIndexController extends Controller
{
    
    public function index()
    {
        $ToDoLists =ToDoLists::all();
        $Users = Users::all();
        //dd($Users);
          return view('todolist.index',[
              'ToDoLists' => $ToDoLists,
              'Users' => $Users
          ]);
    }
    public function test(){
        $ToDoLists = ToDoLists::get();
        return response()->json($ToDoLists);
    }
    public function jobIn(Request $request)
    {
          $ToDoLists = new ToDoLists();
        //  $ToDoLists->user_id=$request->user_id;
        //  $ToDoLists->user_name=$request->user_name;
        //  $ToDoLists->job=$request->job;
        //$request=$request.json();
        //  $ToDoLists->done=false;
        //  $ToDoLists->save();
        // return $ToDoLists;
        $ToDoLists = ToDoLists::create($request->all());
       // return redirect('ToDoList');
       //$user_name = $request->user_name;
       //return response()->json('$user_name');
       //return response()->$request->job;
       
    
    }
    public function jobKill(Request $request)
    {
        $ToDoLists = new ToDoLists();
       // $ToDoLists ->delete($request->id);
        $ToDoLists = ToDoLists::where('id','=',$request->id)->delete();

    }
    public function addUser(Request $request)
    {
        $Users = Users::create($request->all());
        return $Users;
        //$Users ->Users::create($request->all());
        //return redirect('/ToDoList');
    }
    public function queryUsers()
    {
        $Users = Users::get();
        //$Users = DB::table('users')->get();
        return response()->json($Users);
    }
    public function jobDone(Request $request)
    {
        $ToDoLists = new ToDoLists();
        $ToDoLists = ToDoLists::where('id','=',$request->id)->update(['done' => 1]);
        //return $request->id;
        //::where('id', $request.id)->update(['done'=>1]);
        //todolists::where('id','=',$request->id)->update(['done' => 0]);
       // return response()->json($ToDoLists);
    }

}

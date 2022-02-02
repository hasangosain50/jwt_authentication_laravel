<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use DB;

class AgentController extends Controller
{

    // $request->email;
    // $request->password;
    // $request->uniqid;
    // /*

        // email,password,unique_id

        // if(password == "" || password == null || isempty(password)){
        //     select * from tbal where email = "" and unique_id = ""
            
        // }else{
        //     select * from tbal where email = "" and password = ""

        //      $result=$agent->save();
        // if($result){

        // }
        // }

    

    public function agentregister(Request $request){
         $results = DB::select("select * from agents where email='$request->email' ");
        $rowcount=count($results);
        if($rowcount!=0){
            
            return ["result" =>"Email already exist"];
        }
        else{
        $agent=new Agent;
        $agent->fname=$request->fname;
        $agent->mname=$request->mname;
        $agent->lname=$request->lname;
        $agent->email=$request->email;
        if(!empty($request->password)){
            $agent->password=sha1($request->password);
        }
        $agent->unique_id=$request->unique_id;
        $agent->account_created =$request->account_created;
        $agent->status=0;
        $agent->office = $request->office;
        if ($request->hasfile('broker_photo')) {
            $file = $request->file('broker_photo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/broker_photo/', $filename);
            $agent->broker_photo = $filename;
        } else {
            return $request;
            $pages->image = '';
        }
       
        $result=$agent->save();
        if($result){
            return ["result" =>"Agent registered successfully"];
        }
    }

    }

    public function login(Request $request){
        $email=$request->email;
        $password=$request->password;
        $unique_id=$request->unique_id;
        // return response()->json(["result"=>"Account log in succesfully"]);
        if($password == "" || $password == null ){
            $agent=Agent::where('email', $email)->where('unique_id', $unique_id)->get()->toArray();
            if($agent){
                return response()->json(["status" => 200,"result"=>"Account log in succesfully"]);
            }
            else{
                return response()->json(["status" => 400,"result"=>"Account log in succesfully"]);
            
            }
           
            }
            else{
                $agent=Agent::where('email' , $email)->where('password', sha1($password))->get()->toArray();
                if($agent){
                    return response()->json([
                        "result"=>"Account log in succesfully"
                    ],200);
                } else{
                    return response()->json([
                        "result"=>"Login Failed"
                    ],400);
                
                }
               

    }
}
}

<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class ExportController extends Controller
{
    public function exportFilteredUsers(Request $request)
    {
        $serializedUsers = $request->query('users');
        $fields = json_decode($serializedUsers, true);
        $query = User::query();
        $flag=0;
        // Apply filters based on user selections
        $selectedrole = $fields['selectedrole'];
        $selectedscnum = $fields['selectedscnum'];
        $selectedposition = $fields['selectedposition'];
        $selectedworkplace = $fields['selectedworkplace'];
        $selectedcountry = $fields['selectedcountry'];
        $selectedqualification = $fields['selectedqualification'];

        if($selectedrole!=""){
            $query->where('role', $selectedrole);
            $flag = 1;
        }

        if($selectedposition!="All"){
            $query->where('position', $selectedposition);
            $flag = 1;
        }

        if($selectedworkplace!="All"){
            $query->where('workplace', $selectedworkplace);
            $flag = 1;
        }

        if($selectedcountry!=""){
            $query->where('country', $selectedcountry);
            $flag = 1;
        }

        $users = $query->get();

        if($selectedscnum!=""){
            foreach($users as $key=>$user){
                $scParts = explode('/', $user['scnum']);
                if($selectedscnum!=$scParts[1]){
                    unset($users[$key]);
                }
            }
            $flag = 1;
        }

        if($selectedqualification!=""){
            foreach($users as $key=>$user){
                if(empty($user['qualifications'])){
                    unset($users[$key]);
                }
                else{
                    $qualifications = explode(',', $user['qualifications']);
                    if(!in_array($selectedqualification, $qualifications)){
                        unset($users[$key]);
                    }
                }

            }
            $flag = 1;
        }

        if($flag==0){
            $users=User::all();
        }

        return Excel::download(new UsersExport($users), 'Alumni.xlsx');
    }
}

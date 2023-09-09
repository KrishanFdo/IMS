<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportFilteredUsers(Request $request)
    {
        $serializedUsers = $request->query('users');
        $users = json_decode($serializedUsers, true);
        return Excel::download(new UsersExport($users), 'Alumni.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function autoredirect(Request $request)
    {
        $user = $request->user();
        $role = $user->role->id;

        switch ($role) {
            case 1:
                return redirect('admin-coordinators');
            case 2:
                return redirect('coord-programs');
            case 3:
                return redirect('volunt-programas');
            case 4:
                return redirect('donor-donations');
            case 5:
                return redirect('benef-myinfo');
        }
    }
}

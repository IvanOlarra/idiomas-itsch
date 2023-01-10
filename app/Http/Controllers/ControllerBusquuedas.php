<?php

namespace App\Http\Controllers;

use App\Models\User;


use Illuminate\Http\Request;

class ControllerBusquuedas extends Controller
{
    public function email(Request $request)
    {

        $term = $request->get('q');

        $querys = User::where('email', 'LIKE', '%' . $term . '%')->get();

        $data = [];
        foreach ($querys as  $query) {
            $data[] = [
                'label' => $query->email

            ];
        }
        return $data;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function index()
    {
        //catidad de usuarios
        $users = User::count();
        //cantidad de publicaciones
        $posts = Publication::count();
        //cantidad de dotores
        $doctors = Worker::count();

        return inertia(
            'admin/index',
            [
                'title' => 'Admin',
                'subtitle' => 'Gestión General',
                'users' => $users,
                'posts' => $posts,
                'doctors' => $doctors,
                

            ]
        );
    }
}

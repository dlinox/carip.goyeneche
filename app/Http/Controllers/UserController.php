<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);

        $query = $this->user->query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        $users = $query->paginate($perPage)->appends($request->query());



        return inertia(
            'admin/users/index',
            [
                'title' => 'Usuarios',
                'subtitle' => 'Gestión de usuarios',
                'items' => $users,
                'filters' => [
                    'search' => $request->search,
                    'perPage' => $perPage,
                ],
                'headers' => $this->user->headers,
                'areas' => Area::all(),
                'permissions' => config('app.permissions'),

            ]

        );
    }


    public function store(UserRequest $request)
    {
        try {
            $data = $request->all();
            $data['username'] = $data['email'];
            $user = User::create($data);
            $peminssions = collect($data['permissions'])->pluck('name');
            $user->syncPermissions($peminssions);
            return redirect()->back()->with('success', 'Usuario creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al crear el usuario',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $data = $request->all();
            $data['username'] = $data['email'];
            $user->update($data);
            $peminssions = collect($data['permissions'])->pluck('name');
            $user->syncPermissions($peminssions);
            return redirect()->back()->with('success', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al actualizar el usuario',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('success', 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al eliminar el usuario',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function changeState(string $id)
    {
        $user = User::find($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->back()->with('success', 'Estado cambiado exitosamente.');
    }
}

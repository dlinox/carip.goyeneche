<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';
    protected $permisos = [];

    protected $menu = [];

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [

            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
                'data' => fn () => $request->session()->get('data'),
            ],

            'user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email', 'role', 'area_id')
                : null,

            'menu' => fn () => $request->user() ?  $this->getMenuUser($request->user()) :  null,


        ]);
    }

    public function getMenuUser($user)
    {
        $this->menu = config('app.menu', []);

        $user->getAllPermissions()->map(function ($permiso) {
            array_push($this->permisos, $permiso->name);
        });

        $menu = [];


        foreach ($this->menu as $item) {

            $can  =  explode("|", $item['can']);
            if (array_intersect($can,  $this->permisos)  || $item['can'] == null) {
                if ($item['group'] == null) {
                    array_push($menu, $item);
                } else {
                    $group = [];
                    foreach ($item['group'] as $subitem) {
                        $can  =  explode("|", $subitem['can']);

                        if (array_intersect($can,  $this->permisos)  || $subitem['can'] == null) {
                            array_push($group, $subitem);
                        }
                    }
                    if (count($group) > 0) {
                        $item['group'] = $group;
                        array_push($menu, $item);
                    }
                }
            }
        }

        return $menu;
    }
}

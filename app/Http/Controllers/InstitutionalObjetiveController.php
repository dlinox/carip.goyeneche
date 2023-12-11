<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitutionalObjetiveRequest;
use App\Models\InstitutionalObjetive;
use Illuminate\Http\Request;

class InstitutionalObjetiveController extends Controller
{
    public function store(InstitutionalObjetiveRequest $request)
    {

        try {
            InstitutionalObjetive::create($request->all());
            return redirect()->back()->with('success', 'Objetivo actualizado correctamente');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el objetivo', 'exception', $th->getMessage());
        }
    }


    public function update(InstitutionalObjetiveRequest $request, string $id)
    {

        try {
            InstitutionalObjetive::find($id)->update($request->all());
            return redirect()->back()->with('success', 'Objetivo actualizado correctamente');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el objetivo', 'exception', $th->getMessage());
        }
    }

    public function changeState($id)
    {

        try {
            $objetive = InstitutionalObjetive::find($id);
            $objetive->is_active = !$objetive->is_active;
            $objetive->save();

            return redirect()->back()
                ->with('success', 'Estado del objetivo actualizado exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el objetivo', 'exception', $th->getMessage());
        }
    }
    public function destroy(string $id)
    {

        try {
            InstitutionalObjetive::find($id)->delete();
            return redirect()->back()->with('success', 'Objetivo eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el objetivo', 'exception', $th->getMessage());
        }
    }
}

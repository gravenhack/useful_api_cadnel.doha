<?php

namespace App\Http\Controllers;

use App\Models\Module;

use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all(['id', 'name', 'description']);

        return response()->json($modules, 200);

        
    }

    public function activate(Request $request, $id)

    {
        $module = Module::find($id);

        if (!$module) {

            return response()->json([], 404);

        }

        $user = $request->user();
        

        $user->modules()->syncWithoutDetaching([
            $id => ['active' => true]
        ]);

        return response()->json(['message' => 'Module activated'], 200);

    }

    public function deactivate(Request $request, $id)
    {
        $module = Module::find($id);

        if (!$module) {
            return response()->json([], 404);
        }

        $user = $request->user();

        $user->modules()->syncWithoutDetaching([
            $id => ['active' => false]
        ]);

        return response()->json(['message' => 'Module deactivated'], 200);
    }


}

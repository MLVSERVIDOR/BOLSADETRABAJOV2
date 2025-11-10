<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{   

    public function __construct()
    {
        $this->middleware('permission:ver-modulo|crear-modulo|editar-modulo|borrar-modulo')->only('index');
        $this->middleware('permission:crear-modulo', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-modulo', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-modulo', ['only' => ['destroy']]);
    }


    public function index()
    {
        $modules = Module::all();
        return view('module.index', compact('modules'));
    }

    public function create()
    {
        return view('module.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Module::create($request->all());

        return redirect()->route('modules.index')->with('success', 'Module created successfully.');
    }

    public function edit($id)
    {
        $module = Module::findOrFail($id);
        return view('module.edit', compact('module'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $module = Module::findOrFail($id);
        $module->update($request->all());

        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }

    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Module deleted successfully.');
    }
}

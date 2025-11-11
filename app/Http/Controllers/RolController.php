<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

//agregamos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;


class RolController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol', ['only' => ['index']]);
        $this->middleware('permission:crear-rol', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }


public function index(Request $request)
{
    $search = $request->input('search');
    $perPage = $request->input('perPage', 5);
    $sort = $request->input('sort', 'roles.id');
    $direction = $request->input('direction', 'asc');

    $query = "
        SELECT
            roles.id as id,
            roles.name as nombre
        FROM roles"; 

    $params = [];

    // Añadir filtros de búsqueda
    if ($search) {
        $query .= " WHERE (roles.name LIKE ?)";  // nunca pasar el id.
        $params[] = "%$search%";
    }

    // Añadir ordenación
    $query .= " ORDER BY $sort $direction"; 

    // Ejecutar la consulta y obtener los resultados
    $results = DB::select($query, $params);

    // Paginación
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $itemCollection = collect($results);
    $currentPageItems = $itemCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

    $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
    $paginatedItems->setPath($request->url());

    // Si la solicitud es AJAX, devuelve JSON
    if ($request->ajax()) {
        return response()->json([
            'html' => view('roles.index_table', compact('paginatedItems'))->render(),
            'pagination' => $paginatedItems->links()->render()
        ]);
    }

    // Retorna la vista con los parámetros de paginación
    return view('roles.index', compact('paginatedItems', 'search', 'perPage', 'sort', 'direction'));
}




    public function create()
    {
        $modules = DB::select("
            SELECT 
                permissions.id AS id,
                permissions.module_id AS module_id,
                permissions.name AS name_permissions,
                modules.name AS name_module
            FROM 
                permissions 
            INNER JOIN 
                modules 
            ON 
                permissions.module_id = modules.id
        ");
    
        // Agrupa los permisos por module_id
        $groupedModules = [];
        foreach ($modules as $module) {
            $groupedModules[$module->module_id]['name_module'] = $module->name_module;
            $groupedModules[$module->module_id]['permissions'][] = $module;
        }
    
        return view('roles.crear', compact('groupedModules'));
    }
    



    public function store(Request $request)
    {
        try {
            // Validar la entrada del formulario
            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name',
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,id',
            ]);

            // Crear el nuevo rol
            $role = new Role();
            $role->name = $request->input('name');
            $role->save();

            // Asignar permisos al nuevo rol
            if ($request->has('permissions')) {
                $permissions = $request->input('permissions');
                $role->permissions()->sync($permissions); // Asigna los permisos al rol
            }

            // Redirigir a la lista de roles con un mensaje de éxito
            return redirect()->route('roles.index')->with('success', 'Rol creado con éxito.');

        } catch (ValidationException $e) {
            // Redirigir con errores
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
    }



   
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        // Obtener el rol por su ID junto con los permisos asociados
        $role = Role::findOrFail($id);
        
        // Obtener todos los módulos y permisos para mostrar en el formulario
        $modules = DB::select("
            SELECT 
                permissions.id AS id,
                permissions.module_id AS module_id,
                permissions.name AS name_permissions,
                modules.name AS name_module
            FROM 
                permissions 
            INNER JOIN 
                modules 
            ON 
                permissions.module_id = modules.id
        ");
    
        // Agrupar los permisos por module_id
        $groupedModules = [];
        foreach ($modules as $module) {
            $groupedModules[$module->module_id]['name_module'] = $module->name_module;
            $groupedModules[$module->module_id]['permissions'][] = $module;
        }
    
        // Obtener los IDs de permisos asociados al rol
        $selectedPermissions = $role->permissions()->pluck('id')->toArray();
    
        return view('roles.editar', compact('role', 'groupedModules', 'selectedPermissions'));
    }
    


    
    public function update(Request $request, $id)
    {
        // Validar la entrada del formulario, asegurando que el nombre del rol sea único excepto para el rol actual
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
    
        // Obtener el rol por su ID
        $role = Role::findOrFail($id);
    
        // Actualizar los datos del rol
        $role->name = $request->input('name');
        $role->save();
    
        // Actualizar los permisos asociados al rol
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $role->permissions()->sync($permissions);
        } else {
            $role->permissions()->detach();
        }
    
        // Redirigir a la lista de roles con un mensaje de éxito
        return redirect()->route('roles.index')->with('success', 'Rol actualizado con éxito.');
    }
    

    


   
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'staut'=>1,
            'Roles'=> Role::all(),
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $infoRoleValide=$request->validated();
        $role= Role::create($infoRoleValide);
        if($role){
            return response()->json([
                'staut'=>1,
                'message'=> 'Role enregistré avec succè',
            ]);
        }else{
            return response()->json([
                'statut'=>0,
                'message'=> 'Role non enregistré',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        if($role->exists()){
            return response()->json([
                'statut'=>1,
                'role'=> $role,
            ]);
        }else{
            return response()->json([
                'statut'=>0,
                'message'=> 'role non trouvée',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        if($role){
            
            $infoRoleValide=$request->validated();
        $role->nom = $infoRoleValide['nom'];
        $role->description = $infoRoleValide['description'] ;
        if($role->update()){
            return response()->json([
                'statut'=>1,
                'message'=> 'Role modifié',
            ]);
        }else{
            return response()->json([
                'statut'=>0,
                'message'=> 'Role non modifié',
            ]);
        }
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if($role){
           
            if($role->delete()){
                
                    return response()->json([
                        'statut'=>1,
                        'message'=> 'Role supprimée',
                    ]);
                }else{
                    return response()->json([
                        'statut'=>0,
                        'message'=> 'Role non supprimée',
                    ]);
                }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use GuzzleHttp\Promise\Create;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         
            return response()->json([
                'statut'=>1,
                'categories'=> Categorie::all(),
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
    public function store(StoreCategorieRequest $request)
    {
        $infoCategorieValide=$request->validated();
        $categorie= Categorie::create($infoCategorieValide);
        if($categorie){
            return response()->json([
                'statut'=>1,
                'message'=> 'Categorie enregistré avec succè',
            ]);
        }else{
            return response()->json([
                'statut'=>0,
                'message'=> 'Categorie non enregistré',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        if($categorie->exists()){
            return response()->json([
                'statut'=>1,
                'categorie'=> $categorie,
            ]);
        }else{
            return response()->json([
                'statut'=>0,
                'message'=> 'Categorie non trouvée',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        if($categorie){
            
            $infoCategorieValide=$request->validated();
        $categorie->nom = $infoCategorieValide['nom'];
        $categorie->description = $infoCategorieValide['description'] ;
        if($categorie->update()){
            return response()->json([
                'statut'=>1,
                'message'=> 'Categorie modifié',
            ]);
        }else{
            return response()->json([
                'statut'=>0,
                'message'=> 'Categorie non modifié',
            ]);
        }
    }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        if($categorie){
           
            if($categorie->delete()){
                
                    return response()->json([
                        'statut'=>1,
                        'message'=> 'Categorie supprimée',
                    ]);
                }else{
                    return response()->json([
                        'statut'=>0,
                        'message'=> 'Categorie non supprimée',
                    ]);
                }
        }
    }
}

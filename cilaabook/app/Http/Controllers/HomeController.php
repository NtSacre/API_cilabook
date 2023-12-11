<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
          
            'projets'=>Projet::orderBy('created_at', 'desc')->where('is_deleted', 0)->paginate(20),
            'categories'=>Categorie::pluck('nom')->toArray(),

        ],200);
       
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        if($projet){
          
            $porteurprojet= User::where('id', $projet->user_id)->first();
            $tousSesProjet= Projet::where('user_id',$projet->user_id)->get();
            return response()->json([
            
                'le_projet_demander'=>$projet,
                'tousSesProjet'=>$tousSesProjet,
                'porteurprojet'=>$porteurprojet
            ],200);
        }else{
            return response()->json([
                
                'message' => "Erreur l'evenement non trouvé",
            ],201); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

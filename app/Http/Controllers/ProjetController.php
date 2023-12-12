<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreProjetRequest;
use App\Http\Requests\UpdateProjetRequest;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $projet = Projet::where('is_deleted', 0)
         ->where('user_id', Auth::user()->id)
         ->paginate(1);
        if($projet){
            return response()->json([
                'statut'=>1,
               
                'projets' => $projet,
            ]);
        }else{
            return response()->json([
                'statut'=>0,
               
                'projets' =>'Aucun projet enregistré',
            ]);
        }
       

    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjetRequest $request)
    {
       try {
      
        $donneeProjetValide = $request->validated();
        $image = $request->file('image');

        if ($image !== null && !$image->getError()) {
            $donneeProjetValide['image'] = $image->store('image', 'public');
        }
       
      
        $donneeProjetValide['user_id']=Auth::user()->id;
        
        $projet = new Projet($donneeProjetValide);

        if ($projet->save()) {
            return response()->json([
                
                "message" => "le projet à été enregistrer avec succès"
            ], 201);
        } else {
            return response()->json([
              
                "message" => "le projet n'a pas été enregistrer"
            ], 500);
        }
       } catch (\Throwable $th) {
        return response()->json([
            "status" => 0,
            "messageErreur" => $th,
        ]);
       }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        if($projet){
            return response()->json([
                
                'projet' => $projet,
            ], 200);
        }else{
            return response()->json([
                
                'message' => "Erreur projet non trouvé",
            ], 404); 
        }
        
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projet $projet)
    {
   
        $donneeProjetValide = $request->validate([
            "titre" => ['required','string','min:2'],
            "description" => ['required','string','min:5'],
            "statut" => ['required'],
            "image" => ['required', 'image'],
            "categorie_id" => ['required'],
        ]);
        $image = $request->file('image');

       

        if ($image !== null && !$image->getError()) {
            if ($projet->image) {
                Storage::disk('public')->delete($projet->image);
            }
            $donneeProjetValide['image'] = $image->store('image', 'public');
        }
      
        $donneeProjetValide['user_id']=Auth::user()->id;
        if ($projet->update($donneeProjetValide)) {
            return response()->json([
                "status" => 1,
                "message" => "le projet à été modifier avec succès"
            ], 200);
        } else {
            return response()->json([
               
                "message" => "le projet n'a pas été modifier"
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        if($projet){
            $projet->is_deleted =1;
            
            if($projet->save()){
                return response()->json([
                    "status" => 1,
                    "message" => "le projet à été supprimer avec succès"
                ], 201);
            } else {
                return response()->json([
                    "status" => 0,
                    "message" => "le projet n'a pas été supprimer"
                ],404);
            }
        }
    }
}

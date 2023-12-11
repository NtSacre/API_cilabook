<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Projet;
use App\Models\lessorProjet;
use Illuminate\Http\Request;
use App\Mail\MessageRendezVous;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactPorteurProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function messageWhatsapp(User $user)
    {
        if($user){
           
            $numeroWhatsApp=$user->telephone;
            $messageWhatsappEnvoye= "https://api.whatsapp.com/send?phone=$numeroWhatsApp";
            return redirect()->to($messageWhatsappEnvoye);
            // return response()->json([
            //     'message' => 'ok'
            // ], 200);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Projet $projet, Request $request)
    {
     
     
        if($projet){
            
            $donneesFormulaire= $request->validate([
                'message'=>['required'],
            ]);
          
            $projetContacter= lessorProjet::create([
                'user_id' => Auth::user()->id,
                'projet_id' => $projet->id,
            ]);
            if($projetContacter){
            
                $porteurProjetAContacter= User::where('id', $projet->user_id)->first();
            
                Mail::to($porteurProjetAContacter->email)->send(new MessageRendezVous($donneesFormulaire));
               
                
                
                return response()->json([
                    'message' => 'Le Mail envoyée avec succès'
                ], 201);
            }
        }else{
            return response()->json(
                ['message' => 'Le Mail n\'a pas été envoyée ']
            ,500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

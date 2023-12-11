<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserControlleur extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listeUtilisateurNonBloquer()
    {
        return User::where('is_actived',true)->get();
    }
    
    public function listeUtilisateurBloquer()
    {
        return User::where('is_actived',false)->get();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function toutPorteurNonBloquer()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('nom', 'porteurprojet');
        })
        ->where('is_actived', true)
        ->get();
        dd($users);
        return response()->json([
            'utilisateur' => $users,
        ], 200);
    }
    public function toutBailleurNonBloquer()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('nom', 'bailleur');
        })
        ->where('is_actived', true)
        ->get();
        dd($users);
        return response()->json([
            'utilisateur' => $users,
        ], 200);
    }
    public function bloquerUtilisateur(User $user)
    {
        $user->is_actived = 0;
        if ($user->save()) {
            return response()->json([
                
                'message' => 'Utilisateur bloquer.'
            ], 200);
        } else {
            return response()->json([
              
                'message' => 'Utilisateur non bloquer.'
            ], 500);
        }
    }
    public function toutPorteurBloquer()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('nom', 'porteurprojet');
        })
        ->where('is_actived', false)
        ->get();
       
        return response()->json([
            'utilisateur' => $users,
        ], 200);
    }
    public function toutBailleurBloquer()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('nom', 'bailleur');
        })
        ->where('is_actived', false)
        ->get();
      
        return response()->json([
            'utilisateur' => $users,
        ], 200);
    }
    public function debloquerUtilisateur(User $user)
    {
        $user->is_actived = 1;

        if ($user->save()) {

            return response()->json([
              
                'message' => 'user debloquer.'
            ], 200);
        } else {
            return response()->json([
                
                'message' => 'user non bloquer.'
            ], 500);
        }
    }
    // public function getAllPorteurprojetsUnblock()
    // {
    //     $porteurprojets = Porteurprojet::where('is_deleted', false)->get();
    //     return response()->json([
    //         'porteurprojets' => $porteurprojets,
    //     ], 200);
    // }
    // public function blockPorteurprojet(Porteurprojet $porteurprojet)
    // {
    //     $porteurprojet->is_deleted = 1;
    //     if ($porteurprojet->save()) {

    //         return response()->json([
    //             'statut' => '1',
    //             'message' => 'Porteur de projet bloquer.'
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'statut' => '0',
    //             'message' => 'Porteur de projet non bloquer.'
    //         ], 404);
    //     }
    // }
    // public function getAllPorteurprojetsBlock()
    // {
    //     $porteurprojets = Porteurprojet::where('is_deleted', true)->get();
    //     return response()->json([
    //         'porteurprojets' => $porteurprojets,
    //     ], 200);
    // }
    // public function unblockPorteurprojet(Porteurprojet $porteurprojet)
    // {
    //     $porteurprojet->is_deleted = 0;
    //     if ($porteurprojet->save()) {
    //         return response()->json([
    //             'statut' => '0',
    //             'message' => 'Porteur de projet debloquer.'
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'statut' => '1',
    //             'message' => 'Porteur de projet non bloquer.'
    //         ], 404);
    //     }
    // }

    
}

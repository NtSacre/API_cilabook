<?php

namespace App\Models;

use App\Models\Projet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'description',

     ];
      /**
     * Get the projet for the categorie.
     */
    public function projets(): HasMany
    {
        return $this->HasMany(Projet::class);
    }
}

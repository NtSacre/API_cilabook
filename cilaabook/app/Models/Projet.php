<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projet extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
     ];
     /**
     * Get the categorie for the projet.
     */
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
    /**
     * Get the porteur for the projet.
     */
    public function porteur(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
     /**
     * Get the lessorProjet for the projet.
     */
    public function lessorProjets(): HasMany
    {
        return $this->HasMany(lessorProjet::class);
    }
}

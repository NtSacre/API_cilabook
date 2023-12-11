<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
     ];
      /**
     * Get the user for the role.
     */
    public function users(): HasMany
    {
        return $this->HasMany(User::class);
    }
}

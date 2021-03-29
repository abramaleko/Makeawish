<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishes extends Model
{
    use HasFactory;

    protected $table = "wishes";

/**
 * Get the user that owns the Wishes
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

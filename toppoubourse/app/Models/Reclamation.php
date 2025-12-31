<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reclamation extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the user that owns the Reclamation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the userReception that owns the Reclamation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userReception(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_reception_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class URL extends Model
{
    use SoftDeletes;
    protected $table = 'u_r_l_s';

    protected $fillable = [
        'long_url',
        'shorten_url',
        'user_id',
        'total_clicked',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

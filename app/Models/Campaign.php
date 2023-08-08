<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaigns';

    protected $fillable = [
        'publisher_id',
        'name',
        'status'
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}

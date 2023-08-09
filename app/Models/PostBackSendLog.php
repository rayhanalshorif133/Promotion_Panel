<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostBackSendLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'operator_id',
        'service_id',
        'channel',
        'clicked_id',
        'others',
        'sent_at'
    ];
}

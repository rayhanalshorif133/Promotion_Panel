<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostBackSentLog extends Model
{
    use HasFactory;

    protected $table = 'post_back_sent_logs';

    protected $fillable = [
        'operator_id',
        'service_id',
        'channel',
        'clicked_id',
        'others',
        'sent_at'
    ];
}

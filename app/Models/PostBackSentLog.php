<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostBackSentLog extends Model
{
    use HasFactory;


    protected $fillable = [
        'operator_id',
        'service_id',
        'campaign_id',
        'channel',
        'clicked_id',
        'others',
        'response',
        'post_back_url',
        'sent_at'
    ];


    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }


    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

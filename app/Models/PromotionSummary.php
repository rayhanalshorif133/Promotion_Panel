<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionSummary extends Model
{
    use HasFactory;

    protected $table = 'promotion_summaries';

    protected $fillable = [
        'campaign_id',
        'publisher_id',
        'service_id',
        'operator_id',
        'operation_date',
        'total_traffic',
        'postback_rec',
        'postback_sent',
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }
}

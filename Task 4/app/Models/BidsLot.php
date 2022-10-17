<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BidsLot extends Model
{
    use HasFactory;

    protected $fillable = ["customer","email","mobile","lot_id","price","bid_date"];

    protected $table = "bids_lots";

    public function lotsDetail(): BelongsTo
    {
        return $this->belongsTo(Lots::class, 'lot_id');
    }
}

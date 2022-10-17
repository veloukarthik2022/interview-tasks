<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lots extends Model
{
    use HasFactory;

    protected $fillable = ["email","mobile","company","lot_name","product_name","weight","country","harvest_date","expiry_date","status"];

    protected $table = "lots";

    public static function getAll()
    {
        return Lots::all();
    }
}

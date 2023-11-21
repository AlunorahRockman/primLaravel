<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commande extends Model
{
    use HasFactory;
    protected $table = "commandes";
    protected $primaryKey = "id";
    protected $fillable = [
        "product_id",
        "user_id",
        "date",
        "status",
        "methodPayment"
    ];
}

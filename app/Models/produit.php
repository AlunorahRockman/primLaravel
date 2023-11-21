<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produit extends Model
{
    use HasFactory;
    protected $table = "produit";
    protected $primaryKey = "id";
    protected $fillable = [
        "name",
        "price",
        "description",
        "quantity",
        "brand",
        "created_at"
    ];
}

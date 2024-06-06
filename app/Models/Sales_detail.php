<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_detail extends Model
{
    use HasFactory;
    protected $table = "sales_details";
    protected $fillable = [
        "id",
        "sales_id",
        "menu_id",
        "menu_name",
        "menu_price",
        "quantity",
        "status",
    ];
    protected $primaryKey="id";
    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }
}

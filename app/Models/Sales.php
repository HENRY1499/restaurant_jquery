<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $table="sales";
    protected $fillable=[
        "table_id", 
        "table_name",
        "user_id",
        "user_name",
        "total_price",
        "total_recieved",
        "change",
        "payment_type",
        "status"
    ];
    protected $primaryKey="id";
    public function saleDetails(){
        return $this->hasMany(Sales_detail::class);
    }
}

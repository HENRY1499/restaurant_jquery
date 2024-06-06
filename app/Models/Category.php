<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = "categories";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'name'];

    public static function getAll(){
        return self::paginate(5);
    }

    public function menu(){
        return $this->hasMany(Menu::class);
    }
}

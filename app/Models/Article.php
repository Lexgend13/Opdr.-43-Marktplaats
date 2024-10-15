<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function biddings()
    {
        return $this->hasMany(Bidding::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    
}

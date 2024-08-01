<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_parent_id',
        'category_name',
        'is_active'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_parent_id');
    }

    // Mối quan hệ danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'category_parent_id');
    }
}

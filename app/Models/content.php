<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class content extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function sub_categories()
    {
        return $this->belongsTo(subCategory::class, 'subCategory_id', 'id');
    }
}

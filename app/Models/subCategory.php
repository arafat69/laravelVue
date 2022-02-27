<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategory extends Model
{
    /**
     * Get the category that owns the subCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }
    public function contents()
    {
        return $this->hasMany(content::class, 'subCategory_id', 'id');
    }
}

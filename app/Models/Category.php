<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   /**
    * Get all of the subcategory for the Category
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function subcategory()
   {
       return $this->hasMany(subCategory::class, 'cat_id', 'id');
   }

   public function contents()
   {
       return $this->hasMany(content::class, 'category_id', 'id');
   }
}

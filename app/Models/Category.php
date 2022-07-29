<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id')->orderBy('name','asc');
    }

    public function children(){
        return $this->hasMany(Category::class,'parent_id','id')->orderBy('name','asc');
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class,'created_by','id');
    }
}

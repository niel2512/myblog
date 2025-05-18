<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//menggunakan model binding 
class Post extends Model 
{
 // protected $guarded = ['id']; //ini untuk menjaga agar id tidak dapat diisi
 // protected $table = 'Post'; //ini digunakan kalau table kita tidak menggunakan default table laravel 'Posts' ada s nya
 use HasFactory; //agar bisa memanggil faker di tinker
 protected $fillable = ['title','author','slug','body']; //ini untuk memperbolehkan table tersebut diisi 

 // Melakukan eloquent Eager Loading by Default
 protected $with = ['author','category']; //pakai eager query apabila query nya kebanyakan

 public function author(): BelongsTo
 {
  return $this->belongsTo(User::class);
 }
 public function category(): BelongsTo
 {
  return $this->belongsTo(Category::class);
 }

 // Menambah query scope untuk filter search
 #[Scope]
 protected function filter(Builder $query, array $filters): void
 {
    // logika untuk searchable dengan null coalescing operator
    // menggunakan method when yang ada di collection

    // ini when untuk mencari search (blog)
    $query->when($filters['search'] ?? false, function ($query, $search){
          return $query->where('title', 'like', '%' . request('search').'%');
    });
    
    // ini untuk mencari category 
    $query->when($filters['category'] ?? false, function ($query, $category) {
     // Melakukan return dengan arrow function
          return $query->whereHas('category', fn(Builder $query) => $query->where('slug', $category));
    });

    // ini untuk mencari category 
    $query->when($filters['author'] ?? false, function ($query, $author) {
          return $query->whereHas('author', fn(Builder $query) => $query->where('username', $author));
    });
 }
}
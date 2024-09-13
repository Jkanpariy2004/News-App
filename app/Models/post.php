<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $table='post';
    protected $primaryKey = 'id';

    protected $fillable = ['title', 'description', 'category', 'thumbnail_image', 'auther_name', 'publish_date'];
}
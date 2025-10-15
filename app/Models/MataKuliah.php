<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';
    protected $fillable = ['nama_mk', 'sks'];

    public $incrementing = false; // karena UUID bukan auto increment
    protected $keyType = 'string'; // UUID bertipe string

    protected static function boot()
    {
        parent::boot();

        // otomatis generate UUID saat create
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Distributor extends Model
{
    use HasFactory;
    protected $table = 'distributors';

    protected $fillable = [
        'nama_distributor',
        'kota',
        'provinsi',
        'kontak',
        'email',
    ];

    public function products()
    {
        return $this->hasMany(product::class, 'id_distributor');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBarang extends Model
{
    protected $table = 'master_barang';

    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(MsterSupplier::class, 'id_supplier');
    }

    public function gudang()
    {
        return $this->belongsTo(MsterGudang::class, 'id_gudang');
    }
    
}

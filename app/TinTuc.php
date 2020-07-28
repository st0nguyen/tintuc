<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    protected $table = "tbl_TinTuc";

    public function loaitin() {
        return $this->belongsTo('App\LoaiTin', 'idLoaiTin', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'idTinTuc', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    protected $table = "tbl_theloai";

    // Create Relationship
    public function loaitin() {
        return $this->hasMany('App\LoaiTin', 'idTheLoai');
    }

    //
    public function tintuc() {
        return $this->hasManyThrough('App\TinTuc', 'App\LoaiTin', 'idTheLoai', 'idLoaiTin', 'id');
    }

}

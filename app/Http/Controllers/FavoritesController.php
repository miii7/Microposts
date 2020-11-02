<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store($Id)
    {
        // 認証済みユーザ（閲覧者）が、 micropost_idをお気に入りする
        \Auth::user()->favorite($Id);
        // 前のURLへリダイレクトさせる
        return back();
    }

    public function destroy($Id)
    {
        // 認証済みユーザ（閲覧者）が、 micropost_idをお気に入りから削除する
        
        \Auth::user()->unfavorite($Id);
        // 前のURLへリダイレクトさせる
        return back();
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    
    public function searchItem(Request $request) {
        if($request->search == "" || $request->search == " ") {
            $searchItems = Item::paginate(10);
        } else {
            $searchItems = Item::where(function($query) use ($request) {
                $query->where('nama_barang', 'LIKE', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $request->search . '%')
                ->orWhere('harga', 'LIKE', '%' . $request->search . '%');
            })->paginate(10);
        }

        return view('ajax.items', [
            'items' => $searchItems
        ]);
    }

    public function filterItem(Request $request) {
        if($request->filter == 'terbaru') {
            $searchItems = Item::orderBy('created_at', 'desc')->pagination(10);
        } elseif($request->filter == 'terlama') {
            $searchItems = Item::orderBy('created_at', 'asc')->pagination(10);
        } elseif($request->filter == 'termahal') {
            $searchItems = Item::orderBy('harga', 'desc')->pagination(10);
        } elseif($request->filter == 'termurah') {
            $searchItems = Item::orderBy('harga', 'asc')->pagination(10);
        } elseif($request->filter == 'tersedia') {
            $searchItems = Item::where('stok', '>', 0)->pagination(10);
        } elseif($request->filter == 'habis') {
            $searchItems = Item::where('stok', '<', 1)->pagination(10);
        } else {
            $searchItems = Item::orderBy('created_at', 'desc')->pagination(10);
        }

        return view('ajax.items', [
            'items' => $searchItems
        ]);
    }

}

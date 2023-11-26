<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    
    public function searchItem(Request $request) {
        if($request->search == "" || $request->search == " "){
            $searchItems = Item::all();
        } else {
            $searchItems = Item::where(function($query) use ($request) {
                $query->where('nama_barang', 'LIKE', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $request->search . '%')
                ->orWhere('harga', 'LIKE', '%' . $request->search . '%');
            })->get();
        }

        return view('ajax.items', [
            'items' => $searchItems
        ]);
    }

}

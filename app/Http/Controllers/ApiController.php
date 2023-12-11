<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ApiController extends Controller
{

    public function items() {
        $items = Item::all();
        return response()->json($items);
    }

}

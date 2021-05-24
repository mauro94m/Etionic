<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Favorito;

class FavoritoController extends Controller
{
    public function index(){
        $resultado = Favorito::where('user_id', Auth::user()->id)->get();
        return response()->json($resultado);
    }

    public function store(Request $request){
        //return $request->favorito;
        $favorito = Favorito::create([
            'titulo' => $request->favorito[1],
            'link' => 'https://hacker-news.firebaseio.com/v0/item/'.$request->favorito[0].'.json?print=pretty',
            'user_id' => Auth::user()->id,
        ]);
    }

    public function destroy(Favorito $favorito){
        $favorito->delete();
    }
}

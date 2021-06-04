<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Favorito;
use App\Models\User;
use App\Notifications\NewFavorito;
use App\Events\FavoritoEvent;

class FavoritoController extends Controller
{
    public function index(){
        $resultado = Favorito::where('user_id', Auth::user()->id)->get();
        return response()->json($resultado);
    }

    public function store(Request $request){
        /*if ($request->user()->cannot('create', Favorito::class)) {
            abort(403);
        }*/
        $this->authorize('create', Favorito::class);
        $favorito = Favorito::create([
            'titulo' => $request->favorito[1],
            'link' => 'https://hacker-news.firebaseio.com/v0/item/'.$request->favorito[0].'.json?print=pretty',
            'user_id' => Auth::user()->id,
        ]);
        
        User::all()->except($favorito->user_id)
                    ->each(function(User $user) use ($favorito){
                        $user->notify(new NewFavorito($favorito));
                    });
    }

    public function destroy(Favorito $favorito){
        $this->authorize('delete', $favorito);
        $favorito->delete();
    }

    public function unreadnotifications(){
        $resultado = Auth::User()->unreadNotifications;
        return response()->json($resultado);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;


class LikeController extends Controller
{
    public function misLikes()
{
    $usuario = auth()->user();
    $likes = $usuario->likes()->with('species')->get();

    return view('likes.index', compact('likes'));
}

    public function store(Request $request)
{
    Like::firstOrCreate([
        'user_id' => auth()->id(),
        'species_id' => $request->species_id,
    ]);

    return back()->with('success', 'Te ha gustado esta especie.');
}

public function destroy($id)
{
    $like = Like::where('user_id', auth()->id())->where('species_id', $id)->first();
    if ($like) {
        $like->delete();
    }

    return back()->with('success', 'Has quitado el me gusta.');
}

public function __construct()
{
    $this->middleware('auth');
}


}

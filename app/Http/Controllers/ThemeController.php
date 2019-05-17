<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use \App\Theme;

class ThemeController extends Controller
{
    public function listar() {
        $temas = Theme::orderBy('nome', 'asc')->get();
        return view('listarTemas')->with('temas', $temas);
    }

    public function listarPorNome(Request $req) {
        $temas = Theme::where('nome', 'like', '%'.$req->input('nome').'%')->get();
        return view('listarTemas')->with('temas', $temas);
    }

    public function cadastrar() {
        return view('cadastrarTema');
    }

    public function store(Request $req) {
        $tema = new Theme();
        $tema->nome = $req->input('nome');
        $user_id = \Auth::user()->id;
        $tema->user_id = $user_id;
        $tema->save();
        return back();
    }

    public function atualizar($id) {
        $tema = Theme::find($id);
        return view('atualizarTema')->with(['tema' => $tema, 'id' => $id]);
    }

    public function update(Request $req) {
        $id = $req->input('id');
        $tema = Theme::find($id);
        $tema->nome = $req->input('nome');
        $tema->save();
        $temas = Theme::orderBy('nome', 'asc')->get();
        return redirect('tema/listar');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Answer;

class AnswerController extends Controller
{
    public function listar() {
        $respostas = Answer::orderBy('id', 'desc')->get();
        return view('listarRespostas')->with('respostas', $respostas);
    }

    public function store(Request $req) {
        $resposta = new Answer();
        $resposta->answer = $req->input('resposta');
        $resposta->user_id = \Auth::user()->id;
        $resposta->post_id = $req->input('post_id');
        $resposta->save();
        return back();
    }
}

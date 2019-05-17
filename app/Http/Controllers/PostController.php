<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\Theme;

class PostController extends Controller
{
    public function listarPorTema($theme_id) {
        $posts = Post::orderBy('id', 'desc')->where('theme_id', $theme_id)->get();
        $temas = Theme::orderBy('nome', 'asc')->get();
        return view('listarPosts')->with(['posts' => $posts, 'temas' => $temas]);
    }

    public function listar() {
        $posts = Post::orderBy('id', 'desc')->get();
        $temas = Theme::orderBy('nome', 'asc')->get();
        return view('listarPosts')->with(['posts' => $posts, 'temas' => $temas]);
    }

    public function listarPorNome(Request $req) {
        $posts = Post::where('titulo', 'like', '%'.$req->input('titulo').'%')->get();
        $temas = Theme::orderBy('nome', 'asc')->get();
        return view('listarPosts')->with(['posts' => $posts, 'temas' => $temas]);
    }

    public function cadastrar() {
        $temas = Theme::orderBy('nome', 'asc')->get();
        return view('cadastrarPost')->with('temas', $temas);
    }

    public function store(Request $req) {
        $post = new Post();
        $post->titulo = $req->input('titulo');
        $post->post = $req->input('texto');
        $post->user_id = \Auth::user()->id;
        $post->theme_id = $req->input('tema');
        $post->save();
        return back();
    }

    public function detalhar($id) {
        $post = Post::find($id);
        return view('detalharPost')->with(['post' => $post, 'id' => $id]);
    }
    
    public function delete($id) {
        $post = Post::find($id);
        $post->delete();
        $posts = Post::orderBy('id', 'desc')->get();
        return redirect('post/listar');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pake where supaya menampilkan isi blog di dashboard hanya dari user yang login
        // $posts = Post::latest()->where('author_id', Auth::user()->id)->paginate(5);

        // Paginate dihilangkan supaya menggantung dulu untuk logika pencarian nanti
        $posts = Post::latest()->where('author_id', Auth::user()->id);

        if(request('keyword')){
            // (% adalah wildcard) (. untuk menggabungkan)
            $posts->where('title', 'like', '%' . request('keyword') . '%');
        }
        // tambahin withQueryString supaya tetap membawa keyword
        return view('dashboard.index', ['posts' => $posts->paginate(5)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // return ('method show');
        // dd($post->all());
        return view('dashboard.show', ['post'=> $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

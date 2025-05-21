<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        // membuat validation dengan pesan eror default laravel
        // $request->validate([
        //     'title' => 'required|unique:posts|min:10|max:30', 
        //     'category_id' => 'required',
        //     'body' => 'required'
        // ]);

        // Membuat custom pesan eror 
        Validator::make($request->all(), [
            'title' => 'required|unique:posts|min:10|max:30',
            'category_id' => 'required',
            'body' => 'required'
        ], [
            // ini general semua eror bakal tampil pesan yg sama
            // 'required' => 'Field :attribute harus di isi woy!'

            // ini custom eror untuk masing masing nya
            'title.required' => 'Field :attribute harus di isi woy!',
            'category_id.required' => 'Pilih salah satu category nya woy!',
            'body.required' => 'Deskripsi gaboleh kosong woy!',
        ], [
            'title' => 'Judul',
            'category_id' => 'Kategori',
            'body'=> 'Deskripsi'
        ])->validate();

        Post::create([
            'title' => $request->title,
            'author_id' => Auth::user()->id, //ini untuk mengambil authornya berdasarkan user yang login
            'category_id' => $request->category_id, //ini diambil dari name di select yang ada di create.blade.php
            'slug' => Str::slug($request->title), //ini menggunakan helper untuk otomatis mengambil slug berdasarkan title yang di input
            'body' => $request->body
        ]);
        
        //menambah flashmessage yaitu pesan yg muncul sekali karna hanya disimpan di session
        return redirect('/dashboard')->with(['success' => 'Success Saved!']); 
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
    public function edit(Post $post)
    {
        return view('dashboard.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validation
        $request->validate([
            // menggunakan class rule untuk mengabaikan required dan unique apabila tidak diubah
            'title' => 'required|min:10|max:30|unique:posts,title' . $post->id, 
            'category_id' => 'required',
            'body' => 'required'
        ]);

        // Update pada database
        $post->update([
            'title' => $request->title,
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title),
            'body' => $request->body
        ]);

        // redirect
        return redirect('/dashboard')->with(['success' => 'Success Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // return $post;
        $post->delete();
        return redirect('/dashboard')->with(['danger' => 'Success Removed!']); 
    }
}

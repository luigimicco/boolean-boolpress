<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::all();
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags', 'post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|unique:posts|min:3',
            'content' => 'required|string',
            'image' => 'string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'cover' => 'image'
        ], [
            'required' => 'Il campo :attribute è obbligatorio',
            'min' => 'Il minimo di caratteri per il campo :attribute è :min',
            'title.unique' => 'Il titolo esiste già'
        ]);

        $data = $request->all();

        $post = new Post();
        $data['user_id'] = Auth::id();
        $post->fill($data);

        $post->slug = Str::slug($post->title, '-');

        $img_path = Storage::put('public', $data['cover']);
        $post->cover = $img_path;

        $post->save();


        // se ho dei tags, creo la relazione
        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);

        return redirect()->route('admin.posts.show', compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();

        //recupero id del post che voglio editare

        $tagIds = $post->tags->pluck('id')->toArray();

        return view('admin.posts.edit', compact('tags', 'post', 'tagIds', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:3'],
            'content' => 'required|string',
            'image' => 'string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'cover' => 'image'

        ], [
            'required' => 'Questo campo è obbligatorio',
            'min' => 'Il minimo di caratteri per il campo :attribute è :min',
            'title.unique' => 'Il titolo esiste già',
            'tags.exists' => 'Uno dei tag ha un valore non valido.'
        ]);

        $data = $request->all();
        // $post->fill($data);
        $data['slug'] = Str::slug($data['title'], '-');
        $img_path = Storage::put('public', $data['cover']);
        $data['cover'] = $img_path;        

        if (!array_key_exists('tags', $data) && ($post->tags) && count($post->tags)) $post->tags()->detach();
        else $post->tags()->sync($data['tags']);

        $post->update($data);

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if (count($post->tags)) $post->tags()->detach();

        $post->delete();
        return redirect()->route('admin.posts.index')->with('alert-message', 'Post eliminato con successo.')->with('alert-type', 'danger');
    }
}

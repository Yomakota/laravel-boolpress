<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPostAdminEmail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::all();
        $page_data = $request->all();
        $deleted = isset($page_data['deleted']) ? $page_data['deleted'] : null;
        $data = [
            'posts' => $posts,
            'deleted' => $deleted
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $data = [
            'categories' => $categories,
            'tags' => $tags,
        ];
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validiamo i campi del form
        $request->validate($this->getValidation());

        // se non ci sono errori li salvo in form_data
        $form_data = $request->all();

        if (isset($form_data['image'])) {
            //carico file nella cartella post-covers
            $img_path = Storage::put('post-covers', $form_data['image']);
            //e salvo il path che torna
            $form_data['cover'] = $img_path;
        }

        //creo un nuovo Post
        $new_post = new Post();
        $new_post->fill($form_data);

        $new_post->slug = $this->getSlug($new_post->title);

        $new_post->save();

        //dopo il salvataggio del post posso attaccare i tag
        if (isset($form_data['tags'])) {
            $new_post->tags()->sync($form_data['tags']);
        }

        //e posso inviare nel caso l'email all'amministratore
        Mail::to('admin@boolpress.it')->send(new NewPostAdminEmail($new_post));
        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        // dd($post->category); per vedere relazione con category

        $time_now = Carbon::now();
        $created_on = $post->created_at->diffInDays($time_now);
        $updated_mins = $post->updated_at->diffInMinutes($time_now);

        // dd($created_on);
        $data = [
            'post' => $post,
            'created_on' => $created_on,
            'updated_mins' => $updated_mins
        ];
        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ];
        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //verifico i dati
        $request->validate($this->getValidation());

        //prendo i data dal form edit
        $form_data = $request->all();

        //prendo post da aggiornare
        $post_to_update = Post::findOrFail($id);

        //se l'immagine ?? presente in $form_data
        if (isset($form_data['image'])) {
            //cancello la vecchia immagine
            if ($post_to_update->cover) {
                Storage::delete($post_to_update->cover);
            }

            // carico la nuova immagine
            $img_path = Storage::put('post-covers', $form_data['image']);
            // e popolo $form-data('cover') com $img_path
            $form_data['cover'] = $img_path;
        }

        // aggiungo all'array dei data lo slug che non ?? nel form
        // si genera lo slug solo se diverso da quello vecchio
        if ($form_data['title'] !== $post_to_update->title) {
            $form_data['slug'] = $this->getSlug($form_data['title']);
        } else {
            $form_data['slug'] = $post_to_update->slug;
        }

        //aggiorno il post
        $post_to_update->update($form_data);

        //aggiorno i tags dopo i posts
        if (isset($form_data['tags'])) {
            $post_to_update->tags()->sync($form_data['tags']);
        } else {
            $post_to_update->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', ['post' => $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::findOrFail($id);

        if ($post_to_delete->cover) {
            Storage::delete($post_to_delete->cover);
        }

        $post_to_delete->tags()->sync([]);
        $post_to_delete->delete();

        return redirect()->route('admin.posts.index', ['deleted' => 'yes']);
    }

    protected function getSlug($title)
    {
        //creamo lo slug
        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;

        //verifico se presente nel db
        $existing_slug_post = Post::where('slug', '=', $slug_to_save)->first();

        //aggiungo un counter fino a quando non trovo un slug libero ossia finch?? la condizione del ciclo diventa null e quindi non presente
        $counter = 1;
        while ($existing_slug_post) {
            $slug_to_save = $slug_base . '-' . $counter;

            //controllo se presente nel db
            $existing_slug_post = Post::where('slug', '=', $slug_to_save)->first();
            $counter++;
        }
        return $slug_to_save;
    }

    protected function getValidation()
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'image' => 'image|max:1024|nullable'
        ];
    }
}
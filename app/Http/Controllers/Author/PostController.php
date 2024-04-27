<?php

namespace App\Http\Controllers\Author;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    private $module, $categories;

    public function __construct()
    {
        $this->middleware(['role:author', 'permission:create post']);
        $this->module = 'Post';
        $this->categories = Category::all();
    }

    /**
     * List of Posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [
            'page_title' => 'My Post',
            'categories' => $this->categories,
            'posts' => Post::with(['category', 'tags'])
                ->where('author_id', auth()->user()->id)
                ->get(),
        ];

        return view('frontend.author.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data = [
            'page_title' => 'New ' . $this->module,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ];

        return view('frontend.author.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($request->title);
            $data['author_id'] = auth()->user()->id;

            if ($request->hasFile('featured_image')) {
                $featuredImage = $request->file('featured_image');
                $featuredImageName = now()->format('YmdHis') . '_.' . $featuredImage->extension();
                $uploaded = Storage::disk('public')->put('images/posts/' . $featuredImageName, file_get_contents($featuredImage));

                \Log::debug('create post file uploaded', [$uploaded]);

                $data['featured_image'] = $featuredImageName;
            }

            $post = Post::create($data);

            if ($request->has('tag_id') && is_array($request->tag_id)) {
                $post->tags()->sync($request->tag_id);
            }

            Alert::success('Success', $this->module . ' added successfully.');
        } catch (\Throwable $th) {
            create_exception_log($this->module . ' creating error: ', $th);
            Alert::error('Error!', $this->module . ' added failed');
        }

        return redirect()->route('author.posts');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        $posts = Post::with(['category', 'tags'])->find($post->id);

        $data = [
            'page_title' => 'Edit Data ' . $this->module,
            'posts' => $posts,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ];

        return view('frontend.author.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($request->title);

            if ($request->hasFile('featured_image')) {
                $deleted = Storage::disk('public')->delete('images/posts/' . $post->featured_image);
                \Log::debug('update post image deleted', [$deleted]);

                $featuredImage = $request->file('featured_image');
                $featuredImageName = now()->format('YmdHis') . '_.' . $featuredImage->extension();
                $moved = Storage::disk('public')->put('images/posts/' . $featuredImageName, file_get_contents($featuredImage));
                \Log::debug('update post image moved', [$moved]);
                $data['featured_image'] = $featuredImageName;
            }

            $post->update($data);

            if ($request->has('tag_id') && is_array($request->tag_id)) {
                $post->tags()->sync($request->tag_id);
            }

            Alert::success('Success', $this->module . ' updated successfully.');
        } catch (\Throwable $th) {
            Alert::error('Error!', $this->module . ' updating error.');
            create_exception_log($this->module . ' updating error: ', $th);
        }

        return redirect()->route('author.posts');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!$post) {
            return back()->with('error', $this->module . ' not found.');
        }

        try {
            Storage::disk('public')->delete('images/posts/' . $post->featured_image);
            $post->delete();
            Alert::success('Success', $this->module . ' deleted successfully.');
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getFile(), $th->getLine());
            create_exception_log($this->module . ' deleting error: ', $th);
            Alert::error('Error!', $this->module . ' deleted error.');
        }

        return redirect()->route('author.posts');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Page;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax() && !$request->hasHeader('X-Inertia')) {
            return $this->datatable($request);
        }
        
        return Inertia::render('Blog/BlogIndex', [
            'create_link' => route('cms.posts.create')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empty_post = new Post;
        $empty_page = new Page;
        $data = array_combine(
            $empty_post->getFillable(),
            array_fill(0, count($empty_post->getFillable()), null)
        );
        $empty_post->fill($data);
        $empty_post['author_id'] = 1; // default author for the moment :)
        $empty_post->page = array_combine(
            $empty_page->getFillable(),
            array_fill(0, count($empty_page->getFillable()), null)
        );
        return Inertia::render('Blog/BlogEdit', [
            'post' => $empty_post->toArray(),
            'save_link' => route('cms.posts.store'),
            'method' => 'post'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->upsert($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('page')->find($id);
        return Inertia::render('Blog/BlogEdit', [
            'post' => $post,
            'save_link' => route('cms.posts.update', [ 'post' => $id ]),
            'method' => 'put'
        ]);
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
        return $this->upsert($request, $id);
    }

    /**
     * Update the specified resource in storage or create a new one.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upsert(Request $request, $id = null)
    {
        DB::transaction(function() use($request, $id) {
            $post = Post::updateOrCreate(['id' => $id], $request->all());
            $page = $request->page;
            $page['slug'] = empty($page['slug']) ? $post->title : $page['slug'];
            $page['expires_at'] = $page['expires_at'] == 1 ? null : $page['expires_at'];
            $post->page()->updateOrCreate(['id' => $post->page->id ?? null], $page);
        });
        return Redirect::route('cms.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return Redirect::route('cms.posts.index');
    }

    /**
     * Return JSON data for yajira datatable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        if ($request->ajax() && !$request->hasHeader('X-Inertia')) {
            $data = Post::with(['author', 'page'])->get(['id', 'title', 'author_id']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return view('actionButtons', compact('row'));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Inertia\Inertia;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::with(['author', 'page'])->get(['id', 'title', 'author_id', 'gallery_id'])->append(['edit_link', 'show_link']);
        // dd($posts->toArray());
        return Inertia::render('Blog/BlogIndex', [
            'create_link' => route('cms.posts.create'),
            'datatable_link' => route('posts.datatable')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Blog/BlogCreate', [
            'store_link' => route('cms.posts.store')
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
        dd($request->all());
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
        $post = Post::with('page')->find($id)->makeHidden('cms_link');
        return Inertia::render('Blog/BlogEdit', [
            'post' => $post,
            'update_link' => route('cms.posts.update', [ 'post' => $id ])
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
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Return JSON data for yajira datatable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
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

<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Post yaratish
        $post = Post::create(['title' => 'My First Post']);

// Video yaratish
        $video = Video::create(['title' => 'My First Video']);

// Commentlarni post va video uchun saqlash
        $post->comments()->create(['comment' => 'Great Post!']);
        $video->comments()->create(['comment' => 'Great Video!']);

// Post va video uchun commentlarni olish
        $postComments = $post->comments;
        $videoComments = $video->comments;

// Natijalar
        foreach ($postComments as $comment) {
            echo "Post Comment: " . $comment->comment . "\n";
        }

        foreach ($videoComments as $comment) {
            echo "Video Comment: " . $comment->comment . "\n";
        }
        dd();



        $links = Link::latest()->paginate(20);
        return view('link.index',[
            'links' => $links,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'link' => 'required|string',
            'type' => 'required|integer|in:1,2',
            'info' => 'nullable|string',
            'status' => 'required|integer|in:0,1',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        Link::create($request->all());
        return redirect()->route('link.index')->with('success','Link created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        return view('link.show',[
            'link' => $link
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        return view('link.edit',[
            'link' => $link
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        $validated = Validator::make($request->all(),[
            'link' => 'required|string',
            'info' => 'nullable|string',
            'type' => 'required|integer|in:1,2',
            'status' => 'required|integer|in:0,1',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        $request->request->remove('_method');
        $request->request->remove('_token');
        $link->update($request->all());
        return redirect()->route('link.index')->with('success','Link updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->route('link.index')->with('success','Link delete successfully');
    }
}

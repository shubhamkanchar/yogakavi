<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_published', true)->latest()->paginate(9);
        return view('blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_published', true)->with(['comments.replies.user', 'comments.user'])->firstOrFail();
        return view('blogs.show', compact('blog'));
    }

    public function storeComment(Request $request, $blogId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $blog = Blog::findOrFail($blogId);

        Comment::create([
            'user_id' => Auth::id(),
            'blog_id' => $blog->id,
            'parent_id' => $request->parent_id,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment posted successfully.');
    }

    public function toggleLike($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        $user = Auth::user();

        $like = $blog->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $blog->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'count' => $blog->likes()->count(),
        ]);
    }

    public function destroyComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}

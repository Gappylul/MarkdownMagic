<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function editor()
    {
        return Inertia::render('Blog/Editor');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        try {
            $blog = auth()->user()->blogs()->create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'slug' => Str::slug($validated['title'])
            ]);

            // Debug line - remove in production
            \Log::info('Created blog:', ['blog' => $blog->toArray()]);

            return redirect()->route('blog.show', [
                'user' => auth()->user()->name,
                'blog' => $blog->slug
            ]);
        } catch (\Exception $e) {
            // Debug line - remove in production
            \Log::error('Blog creation error:', ['error' => $e->getMessage()]);
            
            return back()->withErrors(['error' => 'Failed to create blog post. Please try a different title.']);
        }
    }

    public function storeDraft(Request $request)
    {
        $request->merge(['is_draft' => true]);
        return $this->store($request);
    }

    public function show($userName, $blogSlug)
    {
        try {
            $blog = Blog::with('user')
                ->whereHas('user', function($query) use ($userName) {
                    $query->where('name', $userName);
                })
                ->where('slug', $blogSlug)
                ->firstOrFail();

            // Debug line
            \Log::info('Show blog:', ['blog' => $blog->toArray()]);

            // Return the blog data with the layout
            return Inertia::render('Blog/Show', [
                'blog' => array_merge($blog->toArray(), [
                    'user' => $blog->user->toArray()
                ])
            ]);
        } catch (\Exception $e) {
            \Log::error('Error showing blog:', [
                'error' => $e->getMessage(),
                'userName' => $userName,
                'blogSlug' => $blogSlug
            ]);
            
            return redirect()->route('blog.index')
                ->with('error', 'Blog post not found.');
        }
    }

    public function index(Request $request)
    {
        try {
            \Log::info('Index method called', ['request' => $request->all()]);

            $blogs = Blog::with('user')
                ->when($request->search, function($query, $search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();

            \Log::info('Blogs fetched', ['count' => $blogs->count()]);

            return Inertia::render('Blog/Index', [
                'blogs' => $blogs,
                'filters' => [
                    'search' => $request->search ?? ''
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in index method', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return empty state instead of throwing
            return Inertia::render('Blog/Index', [
                'blogs' => [
                    'data' => [],
                    'links' => [],
                    'from' => 0,
                    'to' => 0,
                    'total' => 0
                ],
                'filters' => [
                    'search' => $request->search ?? ''
                ]
            ]);
        }
    }

    public function dashboard()
    {
        $user = auth()->user();
        $blogs = Blog::with('user')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(5);

        $stats = [
            'total_posts' => Blog::where('user_id', $user->id)->count(),
            'total_words' => Blog::where('user_id', $user->id)
                ->sum(DB::raw('LENGTH(content) - LENGTH(REPLACE(content, " ", "")) + 1')),
            'latest_post_date' => Blog::where('user_id', $user->id)
                ->latest()
                ->first()?->created_at?->diffForHumans() ?? 'No posts yet'
        ];

        return Inertia::render('Dashboard', [
            'blogs' => $blogs,
            'stats' => $stats
        ]);
    }

    public function edit(Blog $blog)
    {
        if ($blog->user_id !== auth()->id()) {
            abort(403);
        }

        return Inertia::render('Blog/Editor', [
            'blog' => $blog
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        if ($blog->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'slug' => Str::slug($validated['title'])
        ]);

        return redirect()->route('blog.show', [
            'user' => auth()->user()->name,
            'blog' => $blog->slug
        ]);
    }

    public function destroy(Blog $blog)
    {
        if ($blog->user_id !== auth()->id()) {
            abort(403);
        }

        $blog->delete();

        return redirect()->route('blog.dashboard')
            ->with('message', 'Blog post deleted successfully.');
    }
} 
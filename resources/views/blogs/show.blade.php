
@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Blog Header -->
                <div class="mb-4">
                    <h1 class="fw-bold mb-3">{{ $blog->title }}</h1>
                    <div class="d-flex align-items-center text-muted">
                        <span class="me-3"><i class="bi bi-calendar3"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                         <span><i class="bi bi-person"></i> Admin</span>
                    </div>
                </div>

                <!-- Featured Image -->
                @if($blog->image)
                    <img src="{{ Storage::url($blog->image) }}" class="img-fluid rounded-4 mb-4 w-100 shadow-sm" alt="{{ $blog->title }}">
                @endif

                <!-- Content -->
                <div class="blog-content fs-5 lh-lg mb-5 text-break">
                    {!! $blog->content !!}
                </div>

                <hr class="my-5">

                <!-- Likes and Interaction -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        @auth
                            <button id="likeBtn" class="btn {{ $blog->isLikedBy(auth()->user()) ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4" onclick="toggleLike({{ $blog->id }})">
                                <i class="{{ $blog->isLikedBy(auth()->user()) ? 'bi bi-heart-fill' : 'bi bi-heart' }}" id="likeIcon"></i> 
                                <span id="likeCount">{{ $blog->likes->count() }}</span> Likes
                            </button>
                        @else
                            <button class="btn btn-outline-danger rounded-pill px-4" disabled>
                                <i class="bi bi-heart"></i> {{ $blog->likes->count() }} Likes
                            </button>
                            <small class="text-muted ms-2">Login to like</small>
                        @endauth
                    </div>
                    <div>
                        <span class="text-muted"><i class="bi bi-chat-dots"></i> {{ $blog->comments->count() + $blog->comments->sum(function($c){ return $c->replies->count(); }) }} Comments</span>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-light">
                    <h4 class="fw-bold mb-4">Comments</h4>

                    @auth
                        <form action="{{ route('blogs.comments.store', $blog->id) }}" method="POST" class="mb-5">
                            @csrf
                            <div class="mb-3">
                                <textarea name="content" class="form-control rounded-3" rows="3" placeholder="Leave a comment..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Post Comment</button>
                        </form>
                    @else
                        <div class="alert alert-info rounded-3 mb-4">
                            Please <a href="{{ route('login') }}" class="alert-link">login</a> to leave a comment.
                        </div>
                    @endauth

                    <div class="comments-list">
                        @forelse($blog->comments as $comment)
                            <div class="comment-item mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center fw-bold text-secondary" style="width: 45px; height: 45px;">
                                            {{ substr($comment->user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="bg-white p-3 rounded-3 shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="fw-bold mb-0">{{ $comment->user->name }}</h6>
                                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1">{{ $comment->content }}</p>
                                        </div>
                                        
                                        @auth
                                            <button class="btn btn-link btn-sm text-decoration-none p-0 mt-1 ms-2" onclick="toggleReplyForm({{ $comment->id }})">Reply</button>
                                            @if(Auth::id() === $comment->user_id)
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this comment?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link btn-sm text-danger text-decoration-none p-0 mt-1 ms-2">Delete</button>
                                                </form>
                                            @endif
                                        @endauth

                                        <!-- Replies -->
                                        @foreach($comment->replies as $reply)
                                            <div class="d-flex mt-3">
                                                <div class="flex-shrink-0">
                                                    <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center fw-bold text-secondary" style="width: 35px; height: 35px;">
                                                        {{ substr($reply->user->name, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="bg-white p-3 rounded-3 shadow-sm border">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <h6 class="fw-bold mb-0 small">{{ $reply->user->name }}</h6>
                                                            <div>
                                                                <small class="text-muted smaller">{{ $reply->created_at->diffForHumans() }}</small>
                                                                @if(Auth::id() === $reply->user_id)
                                                                    <form action="{{ route('comments.destroy', $reply->id) }}" method="POST" class="d-inline ms-2" onsubmit="return confirm('Delete this reply?');">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-link btn-sm text-danger text-decoration-none p-0" style="font-size: 0.8rem;">Delete</button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 small">{{ $reply->content }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Reply Form -->
                                        @auth
                                            <div id="reply-form-{{ $comment->id }}" class="d-none mt-3">
                                                <form action="{{ route('blogs.comments.store', $blog->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <div class="input-group">
                                                        <input type="text" name="content" class="form-control rounded-start" placeholder="Write a reply..." required>
                                                        <button class="btn btn-primary" type="submit">Reply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center">No comments yet. Be the first to share your thoughts!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    function toggleReplyForm(commentId) {
        const form = document.getElementById(`reply-form-${commentId}`);
        form.classList.toggle('d-none');
    }

    function toggleLike(blogId) {
        fetch(`/blogs/${blogId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const btn = document.getElementById('likeBtn');
                const icon = document.getElementById('likeIcon');
                const count = document.getElementById('likeCount');

                count.innerText = data.count;
                if (data.liked) {
                    btn.classList.remove('btn-outline-danger');
                    btn.classList.add('btn-danger');
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill');
                } else {
                    btn.classList.remove('btn-danger');
                    btn.classList.add('btn-outline-danger');
                    icon.classList.remove('bi-heart-fill');
                    icon.classList.add('bi-heart');
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endpush

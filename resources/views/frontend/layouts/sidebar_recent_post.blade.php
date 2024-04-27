<div id="recent-posts">
    <h4>Recent Posts</h4>
    <ul class="list-unstyled">
        @foreach ($sidebar_recent_posts as $sidebarRecentPosts)
            <div class="card mb-3 border-0" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="{{ route('posts.show', ['slug' => $sidebarRecentPosts->slug]) }}">
                            @include('frontend.posts.components.post_image', ['post' => $sidebarRecentPosts])
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('posts.show', ['slug' => $sidebarRecentPosts->slug]) }}"
                                   class="text-decoration-none">
                                    {{ Str::limit($sidebarRecentPosts->title, 30) }}
                                </a>
                            </h5>
                            <span class="badge text-bg-dark mt-1">
                                <i class="fa fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($sidebarRecentPosts->created_at)->format('d F Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </ul>
</div>

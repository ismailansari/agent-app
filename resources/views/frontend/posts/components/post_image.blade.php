@if ($post->featured_image && file_exists(public_path('storage/images/posts/') . $post->featured_image))
    <img
        src="{{ asset('storage/images/posts/' . $post->featured_image) }}"
        class="card-img-top">
@else
    <img src="{{ asset('images/no-image.png') }}" class="card-img-top" @if(isset($detailPage) && $detailPage) width="50%" @endif>
@endif

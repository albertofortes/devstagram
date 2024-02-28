<div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
    {{ $title }}
    
    @if($posts->count())

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($posts as $post)
            <div>
            <a href="{{route('posts.show', ['post' => $post, 'user' => $post->user])}}">
                <img src="{{asset('uploads') . '/' . $post->image}}" alt="imagen del post {{$post->title}}" />
            </a>
            </div>
        @endforeach
        </div>

        <div class="my-10">
        {{$posts->links('pagination::tailwind')}}
        </div>

    @else
        <div class="text-gray-600 uppercase text-sm text-center font-bold">No tienes posts aún.</div>
    @endif
</div>
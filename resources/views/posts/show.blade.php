@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('title')
  {{$post->title}}
@endsection

@section('content')
<div class="flex container mx-auto">
  <div class="md:w-1/2 px-5">
    <img src="{{asset('uploads') . '/' . $post->image}}" alt="imagen del post {{$post->title}}" />
  

    <div class="flex gap-2 mt-3">
        @auth

         <livewire:like-post :post="$post" />

         {{--
            @if ( $post->checkLike(auth()->user() ))
              <form action="{{route('posts.likes.destroy', ['post' => $post])}}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                  </svg>
                </button>
              </form>
            @else
              <form action="{{route('posts.likes.store', ['post' => $post])}}" method="POST">
                @csrf
                <button type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                  </svg>
                </button>
              </form>
            @endif
          --}}

        @endauth
        
       {{-- <p>{{$post->likes->count()}} likes</p> --}}
      </div>

    @auth
      @if ($post->user_id === auth()->user()->id || auth()->user()->role === 1) {{-- User that created the ticket OR superuser (role 1) --}}
        <form action={{route('posts.destroy', $post)}} method="POST" onclick="return confirm('Are you sure you want to delete this item?');">
          @method('DELETE') {{-- methid spoofing  to add methods that are not allowed by browser (only support get and post) --}}
          @csrf
          <input type="submit" value="Eliminar post" class="bg-red-500 text-white rounded-lg p-2 uppercase cursor-pointer" />
        </form>
      @endif
    @endauth
  </div>

  <div class="md:w-1/2 px-5">

    @if (!$post->is_visible)
      <div class="bg-orange-500 text-white my-4 rounded text-sm p-2">Post pendiente de validación</div>
    @endif
    
    <p class="text-gray-800 mb-0 font-bold">Creado por: {{$post->user->username}}</p>
    <p class="text-gray-600 text-sm mb-2">{{$post->created_at->diffForHumans()}}</p><!--https://carbon.nesbot.com/docs/ viene con laravel-->
    <p class="mb-4">{{$post->description}}</p>

    @if (session('message'))
      <div class="bg-green-500 text-white my-4 rounded">{{session('message')}}</div>
    @endif

    @auth
      <div class="mb-4 bg-white p-4 rounded">
        <form action="{{route('comments.store', ['post' => $post, 'user' => $user])}}" method="POST">
          
          @csrf
          
          <p class="text-gray-800 text-sm mb-2"><label for="comment">Agrega un comentario:</label></p>
          <textarea id="comment" name="comment" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Add some text"required></textarea>
        
          @error('comment')
            <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
          @enderror          

          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Comentar</button>
        </form>
      </div>
    @endauth

    
    @if ($post->comments->count())
      <div class="bg-white p-4 rounded">
        <h3>{{$post->comments->count()}} comentarios:</h3>

        @foreach ($post->comments as $comment)
          <div class="py-3 border-gray-100 border-b text-sm">
            <p>{{$comment->comment}}</p>
            <p class="mt-1 text-xs text-gray-300"><a href="#">{{$comment->user->username}}</a>, <span class="text-gray-300">{{$comment->created_at->diffForHumans()}}</span></p>
          </div>
        @endforeach
      </div>
    @endif     

  </div>

</div>
@endsection

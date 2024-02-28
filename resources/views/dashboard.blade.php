@extends('layouts.app')

@section('title')
  
@endsection

@section('content')
  <div class="flex bg-white p-5 rounded-md shadow" style="align-items: center">
    <div class="mr-5">
      <img src="{{ $user->image ? asset('profiles/'. $user->image) : asset('images/user.svg') }}" alt="User default avatar" style="height: 10rem" />
    </div>
    <div class="">
      <div class="flex  gap-2">
        <span class="text-gray-800 mb-1 font-bold">{{ $user->username }}</span>
          @auth
            @if (@auth()->user()->id === $user->id)
              <a href="{{route('profile.index', $user)}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
              </a>
            @endif
          @endauth
          @if ($user->role === 1)
            <span class="flex items-center uppercase text-xs bg-cyan-300 rounded-sm px-2">administrador</span>
          @endif
      </div>

      <p class="text-gray-80 mb-3 text-xs">{{ $user->email }}</p>


      <ul class="text-gary-800 text-xs mb-1 font-bold">
        <li>{{ $user->followers->count() }} <span class="font-normal">@choice('follower|followers', $user->followers->count())</span></li>
        <li>{{ $user->following->count() }}  <span class="font-normal">Following</span></li>
        <li>{{ $user->posts->count() }} <span class="font-normal">Posts</span></li>
      </ul>

      @auth
        @if ( $user->id !== auth()->user()->id )
          @if ( !$user->isFollowing(auth()->user()) )          
            <form action="{{route('users.follow', $user)}}" method="POST" class="mt-5">
              @csrf
              <input type="submit" value="Seguir" class="bg-blue-600 text-white uppercase rounded-md py-1 px-3 cursor-pointer" />
            </form>
          @else
            <form action="{{route('users.unfollow', $user)}}" method="POST" class="mt-5">
              @method('DELETE')
              @csrf
              <input type="submit" value="Unfollow" class="bg-red-600 text-white uppercase rounded-md py-1 px-3 cursor-pointer" />
            </form>
          @endif       
        @endif
      @endauth 

    </div>
  </div>

  <section class="mx-auto mt-10">
    
    <x-post-list :posts="$posts">
      <x-slot:title>
        <h2 class="text-xl text-center font-black my-10">Posts</h2>
      </x-slot:title>
    </x-post-list>

  </section>
@endsection
@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('title')
  Editar perfil: {{auth()->user()->username}}
@endsection

@section('content')
  <div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white p-6">
      <div class="mt-10 md:mt-0">
        <form action="{{ route('profile.store', $user) }}" method="POST" enctype="multipart/form-data">
          @csrf <!--evita ataques, crea token-->
          <div class="mb-3">
            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 @error('username') border-red-500 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Username" value="{{auth()->user()->username}}" required>
          
            @error('username')
              <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
            @enderror
          </div>

          <div class="mb-3">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 @error('name') border-red-500 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your name" value="{{auth()->user()->name}}" required>
          
            @error('name')
              <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 @error('email') border-red-500 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your email" value="{{auth()->user()->email}}" required>
          
            @error('email')
              <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
            @enderror
          </div>

          <div class="mb-3">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imagen</label>
            <input type="file" id="image" name="image" value="" accept=".jpg, .jpeg, .png" class="bg-gray-50 border border-gray-300 @error('username') border-red-500 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"">
          
            @error('username')
              <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
            @enderror
          </div>

          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
     
        </form>
      </div>
    </div>
  </div>
@endsection
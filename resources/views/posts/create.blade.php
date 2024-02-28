@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('title')
  Add new
@endsection

@section('content')
  <div class="md:gap-6 md:flex md:items-center">
    <div class="md:w-1/2">
      <form action="{{route('image.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone bg-gray-200 border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
        @csrf
      </form>
    </div>

    <div class="md:w-1/2 bg-white p-6 shadow-lg rounded-md">
      <form action="{{route('posts.store')}}" method="POST" novalidate>
        @csrf

        <div>
          <input type="hidden" id="image" name="image" value="{{old('image')}}">
        
          @error('image')
            <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-3">
          <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">Title</label>
          <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Post title" value="{{old('title')}}" required>
        
          @error('title')
            <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">Description</label>
          <textarea id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Add some text"required>{{old('description')}}</textarea>
        
          @error('description')
            <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
          @enderror
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </form>
    </div>
  </div>
@endsection
@extends('layouts.app')

@section('title')
  Sign up
@endsection

@section('content')
  <div class="md:gap-6 md:flex md:items-center">
    <div class="md:w-1/2">
      <img src="{{asset('images/register.jpg')}}" alt="Register image" />
    </div>

    <div class="md:w-1/2 bg-white p-6 shadow-lg rounded-md">
      <form action="{{route('register')}}" method="POST">
        @csrf <!--evita ataques, crea token-->
        <div class="mb-3">
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
          <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 @error('name') border-red-500 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your name" value="{{old('name')}}" required>
        
          @error('name')
            <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
          <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 @error('username') border-red-500 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Username" value="{{old('username')}}" required>
        
          @error('username')
            <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
          <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 @error('email') border-red-500 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your email" value="{{old('email')}}" required>
        
          @error('email')
            <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter a password</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 @error('password') border-red-500 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your Password" required>
        
          @error('password')
            <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-5">
          <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Repeat Password" required>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </form>
    </div>
  </div>
@endsection
@extends('layouts.app')

@section('title')
  Login
@endsection

@section('content')
  <div class="md:gap-6 md:flex md:items-center">
    <div class="md:w-1/2">
      <img src="{{asset('images/login.jpg')}}" alt="Register image" />
    </div>

    <div class="md:w-1/2 bg-white p-6 shadow-lg rounded-md">
      <form method="POST" action="{{route('login')}}">
        @csrf <!--evita ataques, crea token-->

        @if (session('message'))
        <p class="bg-red-500 text-white text-sm rounded-lg p-2 my-2">{{session('message')}}</p>
        @endif

        <div class="mb-3">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
          <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email" value="{{old('email')}}" required>
        </div>

        <div class="mb-3">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your Password" required>
        </div>
 
        <div class="mb-5">
          <label class="text-sm"><input type="checkbox" name="remember" /> Remember me</label>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </form>
    </div>
  </div>
@endsection
@extends('layouts.app')

@section('title')
  Home
@endsection

@section('content')
  
  <section class="mx-auto mt-10">
    
    <x-post-list :posts="$posts">
      <x-slot:title></x-slot:title>
    </x-post-list>
  </section>

@endsection
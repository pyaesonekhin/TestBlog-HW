@extends('layouts.master')

@section('title', $post->title)

@section('content')
<div class="col-4 m-auto">
  <div class="card">
    <div class="card-header text-center">
      <h3>Post Detail</h3>
    </div>
    <div class="card-body p-4">
      <h4>{{ $post->title }}</h4>
      <p>{{ $post->body }}</p>
      <p class="mb-5 mt-3 text-end fw-bold"><i>{{ $post->created_at->format('M d, Y') }}</i> by {{ $post->author }}</p>
      <a href="/posts" class="btn btn-outline-secondary d-grid">Go Home</a>
    </div>
  </div>
</div>
@endsection
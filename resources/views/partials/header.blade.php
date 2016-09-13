<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Rk Blog</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/blog.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" />
</head>
<body>
  <div class="blog-masthead">
    <div class="container">
      <nav class="blog-nav">
        <a class="blog-nav-item active" href="{{ url('/') }}">Home</a>
        <a class="blog-nav-item" href="{{ url('/articles/create') }}">Create</a>
        <a class="blog-nav-item" href="{{ url('/about') }}">About</a>
        <a class="navbar-brand" rel="home" href="#">
          @unless(Auth::check())
          <a class="navbar-brand" href="{{ url('/login') }}">Login</a>
          @endunless
          @if(Auth::check())
          <img src="{{ Auth::user()->getAvatarUrl() }}" class="profile-image img-circle">
          <a class="navbar-brand" href="{{ url('/logout') }}">Login</a>
          @endif
        </b></a>
      </a>
    </nav>
  </div>
</div>

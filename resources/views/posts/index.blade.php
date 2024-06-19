@extends('layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/post-banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home-page.css') }}">
@endsection
@section('content')
    <div class="custom-navbar">
        <div class="nav-left">
            <a href="/posts/following" class="{{ request()->is('posts/following') ? "active" : ""}}">ĐANG THEO DÕI</a>
            <a href="/posts/latest" class="{{ request()->is('posts/latest') ? "active" : ""}}">MỚI NHẤT</a>
            <a href="#">EDITORS' CHOICE<span class="custom-dot"></span></a>
            <a href="#">TRENDING<span class="custom-dot"></span></a>
        </div>
        <div class="nav-right">
            @auth
                <a href="/posts/create" class="custom-button-link"><button class="custom-button">VIẾT BÀI</button></a>
            @endauth
        </div>
    </div>
    @foreach($posts as $eachPost)
        <div class="post" style="display: flex; align-items: flex-start;">
            <img src="/avatars/{{ $eachPost->avatar }}" class="avatar" alt="avatar" style="width: 40px; height: 40px; border-radius: 999px; margin-right: 10px;">
            <div class="post-content">
                <div class="post-header">
                    <a href="/users/{{$eachPost->id}}" class="author">{{$eachPost->name}}</a>
                    <span class="post-date">{{ $eachPost->created_at }}</span> - <span class="post-read-time">4 phút đọc</span>
                </div>
                <div class="post-title">
                    <a href="/posts/{{ $eachPost->post_id }}">{{ $eachPost->title }}</a>
                </div>
            </div>
        </div>
    @endforeach
@endsection


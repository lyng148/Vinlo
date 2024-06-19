<style>
    .avatar {
        width: 30px;
        height: 30px;
        border-radius: 999px;
    }
</style>
@extends('layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/post-banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/post-detail.css') }}">
@endsection
@section('content')
    <div class="post-header" style="margin-left: 23%; margin-top: 30px">
        <img src="/avatars/{{ $post[0]->avatar }}" class="avatar" alt="avatar"
             style="width: 45px; height: 45px; border-radius: 999px"></img>
        <a href="/users/{{$post[0]->id}}" class="author">{{$post[0]->name}}</a>
        <span class="post-date">{{ $post[0]->created_at }}</span>
    </div>
    <div class="post-container">
        <div class="vote-container">
            @if($vote_type == 0)
                <a href="/vote/upvote/{{ $post[0]->post_id }}">
                    <button class="vote-button" id="upvote">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                             class="{{$vote_type == 1 ? 'choose' : ''}}">
                            <path d="M12 4l-8 8h16z"/>
                        </svg>
                    </button>
                </a>
            @else
                <a href="/vote/unvote/{{ $post[0]->post_id }}">
                    <button class="vote-button" id="upvote">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                             class="{{$vote_type == 1 ? 'choose' : ''}}">
                            <path d="M12 4l-8 8h16z"/>
                        </svg>
                    </button>
                </a>
            @endif
            @if($vote_type == 0)
                <div class="vote-count">{{ $vote_num[0]->vote_num != 0 ? ($vote_num[0]->vote_num) : '0' }}</div>
                <a href="/vote/downvote/{{ $post[0]->post_id }}">
                    <button class="vote-button {{$vote_type == -1 ? 'choose' : ''}}" id="downvote">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                             class="{{$vote_type == -1 ? 'choose' : ''}}">
                            <path d="M12 20l8-8H4z"/>
                        </svg>
                    </button>
                </a>
            @else
                <div class="vote-count">{{ $vote_num[0]->vote_num != 0 ? ($vote_num[0]->vote_num) : '0' }}</div>
                <a href="/vote/unvote/{{ $post[0]->post_id }}">
                    <button class="vote-button {{$vote_type == -1 ? 'choose' : ''}}" id="downvote">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                             class="{{$vote_type == -1 ? 'choose' : ''}}">
                            <path d="M12 20l8-8H4z"/>
                        </svg>
                    </button>
                </a>
            @endif
        </div>

        <div class="post-content">
            <h1>{{ $post[0]->title }}</h1>
            <p>{!! $post[0]->body !!}</p>
        </div>
    </div>

    <div class="comment-content">
        @auth()
            <h3>Add a Comment</h3>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('post.comment', $post[0]->post_id) }}">
                @csrf
                <div class="form-group">
                    <label for="body">Comment</label>
                    <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                    @error('body')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 20px">Submit</button>
            </form>
        @endauth
        <h2>Comments</h2>
        @if(empty($comments))
            <p>No comments yet.</p>
        @else
            @foreach($comments as $comment)
                <div class="card mb-3">
                    <div class="card-body" style="display: flex; align-items: flex-start">
                        <img src="/avatars/{{ $comment->avatar }}" class="avatar" alt="avatar"
                             style="width: 30px; height: 30px; border-radius: 999px"></img>
                        <div>
                            <a href="/users/{{$comment->id}}" class="author"><h5>{{ $comment->name }}</h5></a>
                            <span style="font-size: 15px">{{ $comment->created_at }}</span>
                            <p class="card-text">{{ $comment->body }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

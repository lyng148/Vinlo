@extends('layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/post-banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user-post.css') }}">
@endsection
@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>


    <div class="infomation">
        <div class="personal">
            <img src="/avatars/{{ $user[0]->avatar }}" class="avatar" alt="avatar" style="width: 70px; height: 70px; border-radius: 999px"></img>
            <div class="thong-tin">
                <h1 class="name">{{$user[0]->name}}</h1>
                <p class="follower">{{$numberOfFollowers[0]->count}} follower</p>
            </div>
        </div>

        @if(Auth::user()->id != $user[0]->id)
            @if($isFollowing[0]->count != 0)
                <form action="/follows/unfollow" method="post">
                    @csrf
                    <input name="followed" type="text" style="display: none" value="{{$user[0]->id}}">
                    <input name="follower" type="text" style="display: none" value="{{Auth::user()->id}}">
                    <button class="btn btn-outline-primary">Unfollow</button>
                </form>

            @else
                @method('PUT')
                <form action="/follows/follow" method="post">
                    @csrf
                    <input name="followed" type="text" style="display: none" value="{{$user[0]->id}}">
                    <input name="follower" type="text" style="display: none" value="{{Auth::user()->id}}">
                    <button class="btn btn-outline-primary">Follow</button>
                </form>
            @endif
        @else
            <div class="edit">
                <a href="/users/{{auth()->id()}}/edit/profile" class="info-edit-button">Edit info</a>
            </div>

        @endif

    </div>

    <div class="navbar">
        <a href="#" onclick="showContent('bai_viet')">Bài viết</a>
        <a href="#" onclick="showContent('following')">Đang theo dõi</a>
        <a href="#" onclick="showContent('follower')">Người theo dõi</a>
    </div>
    <div class="content">
        <div id="bai_viet" class="tab-content" style="display: block">
            <div class="post-list">
                @foreach($posts as $eachPost)
                    <div class="user-post-container">
                        <div class="user-post-content">
                            <div class="post-header">
                                <span class="post-date">{{ $eachPost->created_at }}</span> - <span
                                    class="post-read-time">4 phút đọc</span>
                            </div>
                            <div class="post-title">
                                <a href="/posts/{{ $eachPost->id }}">{{ $eachPost->title }}</a>
                            </div>
                        </div>
                        @if ($user[0]->id == auth()->id())
                        <div class="button-container">
                            <a href="/posts/{{$eachPost->id}}/edit" class="edit-button"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="/posts/{{$eachPost->id}}/delete" class="delete-button"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div id="following" class="tab-content" style="display:none;">Nội dung Series</div>
        <div id="follower" class="tab-content" style="display:none;">
            @if(!empty($followers))
                @foreach($followers as $x)
                    <h2>{{$x->name}}</h2>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        function showContent(tabId) {
            // Hide all tab contents
            var contents = document.querySelectorAll('.tab-content');
            contents.forEach(function (content) {
                content.style.display = 'none';
            });

            // Show the selected tab content
            var activeTab = document.getElementById(tabId);
            if (activeTab) {
                activeTab.style.display = 'block';
            }
        }
    </script>
    <script>
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function(event) {
                var confirmDelete = confirm("Bạn có chắc chắn muốn xóa bài viết này không?");
                if (!confirmDelete) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection

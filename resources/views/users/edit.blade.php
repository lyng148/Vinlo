@extends('layouts.app')
@section('content')
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .alert ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        h1 {
            margin-top: 30px;
            font-size: 24px;
            margin-bottom: 20px;
            color: #007bff;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }



        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .confirm-button{
            padding: 10px;
            border-radius: 999px;
            background-color: white;
            border: solid 1px #0a53be;
            color: #0a53be;
        }

        .confirm-button:hover{
            background-color: #0a53be;
            color: white;
        }

    </style>
    <div class="edit-content" style="display: flex">
        @include('partials.sidebar')
        @if(request()->is('users/' . auth()->id() . '/edit/profile'))
            @include('users.edit.profile')
        @endif
        @if(request()->is('users/' . auth()->id() . '/edit/email'))
            @include('users.edit.email')
        @endif
        @if(request()->is('users/' . auth()->id() . '/edit/password'))
            @include('users.edit.password')
        @endif
        @if(request()->is('users/' . auth()->id() . '/edit/avatar'))
            @include('users.edit.avatar')
        @endif
    </div>
@endsection

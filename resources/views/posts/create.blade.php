@extends('layouts.app')
@section('content')
    <style>
        .title-title{
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .body-title{
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
            margin-top: 10px;
        }
    </style>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create a New Blog Post</h1>
        <form id="postForm" method="POST" action="/posts/create">
            @csrf
            <div class="form-group">
                <label for="title" class="title-title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter post title" required>
            </div>
            <div class="form-group">
                <label for="body" class="body-title">Nội dung bài viết</label>
                <textarea class="form-control" id="body" name="body" rows="5" placeholder="Enter post content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/a0z5crqr09z8e08ovvusjch14014mebad5ca6tslf0f0ik3v/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>
@endsection

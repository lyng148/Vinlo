<div class="container">
    <h1>Chỉnh Sửa Thông Tin Cá Nhân</h1>
    <form action="/users/{{auth()->id()}}/edit/profile" method="POST">
        @csrf
        <div>
            <label for="name">Tên</label>
            <input type="text" name="name" value="">
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div>
            <button type="submit" class="confirm-button">Cập nhật</button>
        </div>
    </form>
</div>

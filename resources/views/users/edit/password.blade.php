<div class="container">
    <h1>Đổi Mật Khẩu</h1>
    <form action="/users/{{auth()->id()}}/edit/password" method="POST">
        @csrf
        <div>
            <label for="current_password">Mật khẩu hiện tại</label>
            <input type="password" name="current_password" required>
        </div>
        <div>
            <label for="password">Mật khẩu mới</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Xác nhận mật khẩu mới</label>
            <input type="password" name="password_confirmation" required>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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

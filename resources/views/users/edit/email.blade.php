<div class="container">
    <h1>Chỉnh Sửa Email</h1>
    <form action="/users/{{auth()->id()}}/edit/email" method="POST">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="" required>
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


<form method="POST" action="/users/{{auth()->id()}}/edit/avatar" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        <label for="avatar" class="col-md-4 col-form-label text-md-end">{{ __('Avatar') }}</label>

        <div class="col-md-6">
            <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" required autocomplete="avatar">

            <img src="/avatars/{{ Auth::user()->avatar }}" style="width:80px;margin-top: 10px;">

            @error('avatar')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Upload Profile') }}
            </button>
        </div>
    </div>
</form>

@php
    $user = $user ?? null;
@endphp

@csrf
<div class="mb-4">
    <label for="username">username</label>
    <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user?->username) }}" autofocus>
    @error('username')
    <div class="invaid-feedback">
        <small class="text-danger">{{ $message }}</small>
    </div>
    @enderror
</div>

<div class="mb-4">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user?->email) }}">
    @error('email')
    <div class="invaid-feedback">
        <small class="text-danger">{{ $message }}</small>
    </div>
    @enderror
</div>
@if($user == null)
    <div class="mb-4">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
        @error('password')
        <div class="invaid-feedback">
            <small class="text-danger">{{ $message }}</small>
        </div>
        @enderror
    </div>
@endif

<div class="mb-4 text-end">
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>

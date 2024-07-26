<x-layout>
    <h1 class="title">Login</h1>
    <div class="mx-auto mx-w-screen-sm card">
        <form action="{{route('login')}}" method="post">
            @csrf
            {{--username--}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" value="{{old('email')}}" name="email" class="input">
                @error('email')
                <p class="error"> {{ $message }}</p>
                @enderror

            </div>
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input">
                @error('password')
                <p class="error"> {{ $message }}</p>
                @enderror

            </div>

            <div class="mb-4">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>

            @error('failed')
            <p class="error"> {{ $message }}</p>
            @enderror
            <button class="primary-btn">Login</button>
        </form>

    </div>
</x-layout>

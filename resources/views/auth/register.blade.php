<x-layout>
    <h1 class="title">Register a new Account</h1>
    <div class="mx-auto mx-w-screen-sm card">
        <form action="{{route('register')}}" method="post">
               @csrf
            {{--username--}}
            <div class="mb-4">
                <label for="username">Username</label>
                    <input type="text" name="username" value="{{old('username')}}" class="input @error('username') ring-red-500 @enderror">
                @error('username')
                   <p class="error"> {{ $message }}</p>
                @enderror

            </div>
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
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="input">


            </div>
            <button class="primary-btn">Register</button>
        </form>

    </div>
</x-layout>

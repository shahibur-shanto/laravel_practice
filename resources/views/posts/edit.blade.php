<x-layout>
    <a class="text-blue-500 underline" href="{{route('dashboard')}}">&larr; Go back to Dashboard</a>
    <div class="card">
        <h2 class="title">Update Your post</h2>
    <form method="post" action="{{route('posts.update',$post)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title">Post Title</label>
            <input type="text" value="{{$post->title}}" name="title" class="input">
            @error('title')
            <p class="error"> {{ $message }}</p>
            @enderror

        </div>
        <div class="mb-4">
            <label for="body">Post Content</label>
            <textarea rows="8"  name="body">{{$post->body}}</textarea>
            @error('body')
            <p class="error"> {{ $message }}</p>
            @enderror

        </div>

        @if($post->image)
        <div class="mb-4">
            {{-- current image if exists--}}

                <img src="{{asset('storage/'.$post->image)}}" alt="">

        </div>
        @endif
        <div class="mb-4">
            @error('image')
            <p class="error"> {{ $message }}</p>
            @enderror
            <label for="image">Cover Photo</label>
            <input  type="file" name="image" id="image"/>
        </div>


        <button class="primary-btn">Update</button>
    </form>
    </div>
</x-layout>

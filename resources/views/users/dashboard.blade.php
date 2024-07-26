<x-layout>
   <h1>Welcome {{auth()->user()->username}}, You have {{$posts->total()}} Posts</h1>
    <div class="card mb-4">
        <h1 class="font-bold mb-4">Create a new Post</h1>


        @if(session('success'))
            <x-flashMsg msg="{{session('success')}}"/>
        @elseif(session('delete'))
            <x-flashMsg msg="{{session('delete')}}"/>
        @endif

        <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" value="{{old('title')}}" name="title" class="input">
                @error('title')
                <p class="error"> {{ $message }}</p>
                @enderror

            </div>
            <div class="mb-4">
                <label for="body">Post Content</label>
                <textarea rows="8"  name="body">{{old('body')}}</textarea>
                @error('body')
                <p class="error"> {{ $message }}</p>
                @enderror

            </div>


            <div class="mb-4">
                @error('image')
                <p class="error"> {{ $message }}</p>
                @enderror
                <label for="image">Cover Photo</label>
                <input  type="file" name="image" id="image"/>
            </div>

            <button class="primary-btn">Create</button>
        </form>
    </div>
    <div>
        <h1 class="font-bold mb-4">Your Latest Posts: </h1>
    </div>
    <div class="grid grid-cols-2 gap-6">
        @foreach($posts as $post)
            <x-postCard :post="$post">
                {{--Add Update Link--}}
                <a class="primary-btn mb-2" href="{{route('posts.edit',$post)}}">Update</a>
                {{-- Add Delete Button--}}
                <form action="{{route('posts.destroy',$post)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="primary-btn">Delete</button>
                </form>
            </x-postCard>

        @endforeach

    </div>
    <div>
        Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} records
    </div>
    <div>
        {{$posts->links()}}
    </div>
</x-layout>

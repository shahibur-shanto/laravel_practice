@props(['post','full'=>false])


<div class="card mb-5">

    <div>
        @if($post->image)
            <img src="{{asset('storage/'.$post->image)}}" alt="">
        @else
            <img src="{{asset('storage/posts_images/default.jpg')}}" alt="">
        @endif
        
    </div>
    <h2 class="font-bold text-xl">{{$post->title}}</h2>
    <div>
        <span>POSTED {{$post->created_at->diffForHumans()}} BY</span>

        <a href="{{route('posts.user', $post->user) }}"
           class="text-blue-500">
            {{$post->user->username}}
        </a>
    </div>

    <div>
        @if($full)
            <span class="text-sm">{{$post->body}}</span>
        @else
            <span class="text-sm">{{Str::words($post->body,15)}}</span>
            <a class="text-blue-500" href="{{route('posts.show',$post)}}">Read More-></a>
        @endif
    </div>
    <div>
        {{$slot}}
    </div>
</div>



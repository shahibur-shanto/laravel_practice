<h1>Hello {{$user->username}}</h1>

<div>
    <h2>You Created {{$post->title}}</h2>
    <p>
        {{$post->body}}
    </p>
    <img src="{{$message->embed('storage/'. $post->image)}}" alt="">
</div>

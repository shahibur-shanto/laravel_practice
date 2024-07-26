<x-layout>
{{--    @auth--}}
{{--        <h1>Logged in User</h1>--}}
{{--    @endauth--}}

{{--    @guest--}}
{{--        <h1>This is a Guest User</h1>--}}
{{--    @endguest--}}

    <h1 class="title">Latest Posts</h1>

{{--    <img src="{{asset('storage/posts_images/4cCrDYnitylFhh8S96MDD5ulRDCCmouVCS9CkFnx.png')}}" alt="Uploaded Image">--}}

    <div class="grid grid-cols-2 gap-6">
    @foreach($posts as $post)
        <x-postCard :post="$post"/>

    @endforeach

    </div>
    <div>
        Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} records
    </div>
    <div>
        {{$posts->links()}}
    </div>
</x-layout>

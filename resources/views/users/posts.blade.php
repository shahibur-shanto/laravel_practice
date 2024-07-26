<x-layout>
    <h1 class="title">{{$username}}</h1>


    {{-- User's Post Here --}}

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

<x-layout>
    <h1 class="mt-4">
        Please verify your email through the email we have sent to you.
    </h1>
    <p>
        didn't get the email?
    </p>
    <form action="{{route('verification.send')}}" method="post">
        @csrf
        <button type="submit" class="primary-btn text-black-100">Send Again</button>
    </form>

</x-layout>

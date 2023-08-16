<x-layout>
    <form method="POST" action="/profile/{{ $user->id }}">
        @csrf
        @method('PATCH')

        <x-form.input name="username" :value="old('username', $user->username)" required />

        <x-form.button>Update</x-form.button>
    </form>
</x-layout>

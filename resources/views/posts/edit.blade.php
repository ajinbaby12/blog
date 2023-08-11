<x-layout>
    <x-setting :heading="'Edit Post: ' . $post->title">
        <form method="POST" action="/posts/{{ $post->id }}">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title', $post->title)" required />
            <x-form.input name="slug" :value="old('slug', $post->slug)" required />

            <x-form.textarea name="excerpt" required>{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
            <x-form.textarea name="body" required>{{ old('body', $post->body) }}</x-form.textarea>

            <x-form.field>
                <x-form.label name="category" />

                <select name="category_id" id="category_id" required>
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ ucwords($category->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="category" />
            </x-form.field>

            <x-form.field>
                <x-form.label name="Status" />
                <select id="status" name="status">
                    <option value="published" {{ $post->status === 'published' ? 'selected' : '' }}>Published
                    </option>
                    <option value="draft" {{ $post->status === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </x-form.field>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>

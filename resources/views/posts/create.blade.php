<x-layout>
    <x-setting heading="Publish New Post">
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" required />
            <x-form.input name="slug" required />
            <x-form.textarea name="excerpt" required />
            <x-form.textarea name="body" required />

            <x-form.field>
                <x-form.label name="category" />
                <select name="category_id" id="category_id" required>
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="category" />

                <x-form.label name="Status" />
                <select id="status" name="status">
                    <option value="published" selected>Published</option>
                    <option value="draft">Draft</option>
                </select>

            </x-form.field>
            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>

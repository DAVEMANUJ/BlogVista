<label for="title">Title</label>
<input id="title" type="text" name="title" value="{{ old('title', $blog->title) }}" required>

<label for="category_id">Category</label>
<select id="category_id" name="category_id">
    <option value="">Select Category</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}" @selected(old('category_id', $blog->category_id) == $category->id)>
            {{ $category->name }}
        </option>
    @endforeach
</select>

<label for="excerpt">Excerpt</label>
<textarea id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $blog->excerpt) }}</textarea>

<label for="content">Content</label>
<textarea id="content" name="content" rows="10" required>{{ old('content', $blog->content) }}</textarea>

<label for="image">Image Path</label>
<input id="image" type="text" name="image" value="{{ old('image', $blog->image) }}">

<label for="published_at">Published At</label>
<input id="published_at" type="datetime-local" name="published_at" value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\TH:i')) }}">

<button type="submit" class="btn">Save Blog</button>

{{--
    Shared form partial for Create / Edit blog.
    Variables expected: $blog (Blog model instance), $categories (Collection)
--}}

{{-- Validation Errors --}}
@if ($errors->any())
<div class="flash flash-error" style="margin-bottom:20px;">
    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6"/></svg>
    <div>
        <strong>Please fix the following errors:</strong>
        <ul style="margin:6px 0 0 16px; padding:0;">
            @foreach ($errors->all() as $error)
                <li style="font-size:.83rem; margin-top:3px;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div style="display:grid; grid-template-columns:1fr 320px; gap:24px; align-items:start;">

{{-- ─── Left column: main content ─── --}}
<div style="display:flex; flex-direction:column; gap:20px;">

    {{-- Title --}}
    <div class="form-group" style="margin-bottom:0;">
        <label class="form-label" for="title">Title <span>*</span></label>
        <input id="title" type="text" name="title" class="form-control"
            value="{{ old('title', $blog->title) }}"
            placeholder="Enter a compelling blog title…"
            required maxlength="255">
        <div class="form-hint">Max 255 characters. The URL slug is auto-generated from the title.</div>
        @error('title') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    {{-- Short Description --}}
    <div class="form-group" style="margin-bottom:0;">
        <label class="form-label" for="short_description">Short Description / Excerpt <span>*</span></label>
        <textarea id="short_description" name="short_description" class="form-control"
            rows="3" maxlength="500"
            placeholder="A brief summary shown in blog listings (max 500 chars)…">{{ old('short_description', $blog->short_description) }}</textarea>
        <div class="form-hint" style="display:flex; justify-content:space-between;">
            <span>Displayed on blog cards and search results.</span>
            <span id="excerpt-count" style="font-weight:600;">0 / 500</span>
        </div>
        @error('short_description') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    {{-- Content (Rich Text) --}}
    <div class="form-group" style="margin-bottom:0;">
        <label class="form-label" for="content">Content <span>*</span></label>
        <textarea id="content" name="content" class="form-control" rows="16"
            placeholder="Write your full blog content here…">{{ old('content', $blog->content) }}</textarea>
        <div class="form-hint">Rich text editor — use the toolbar for formatting, images, links, and more.</div>
        @error('content') <div class="form-error">{{ $message }}</div> @enderror
    </div>

</div>

{{-- ─── Right column: meta & settings ─── --}}
<div style="display:flex; flex-direction:column; gap:16px;">

    {{-- Publish Card --}}
    <div class="card">
        <div class="card-header" style="padding:14px 18px;">
            <div class="card-header-title">Publish Settings</div>
        </div>
        <div class="card-body" style="padding:16px 18px; display:flex; flex-direction:column; gap:14px;">
            {{-- Status toggle --}}
            <div class="form-group" style="margin-bottom:0;">
                <div class="toggle-wrap">
                    <label class="toggle">
                        <input type="checkbox" name="is_published" value="1"
                            {{ old('is_published', $blog->exists ? ($blog->is_published ? '1' : '') : '1') ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <div>
                        <div style="font-size:.85rem; font-weight:600; color:var(--ink);">Published</div>
                        <div style="font-size:.77rem; color:var(--ink-muted);">Visible on the website</div>
                    </div>
                </div>
            </div>

            {{-- Published Date --}}
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="published_at">Publish Date</label>
                <input id="published_at" type="datetime-local" name="published_at" class="form-control"
                    value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\TH:i')) }}">
                <div class="form-hint">Leave blank to use today's date.</div>
                @error('published_at') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="justify-content:center; width:100%;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                    <path d="M17 21v-8H7v8M7 3v5h8"/>
                </svg>
                {{ $blog->exists ? 'Update Blog Post' : 'Publish Blog Post' }}
            </button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary" style="justify-content:center; text-align:center;">
                Cancel
            </a>
        </div>
    </div>

    {{-- Category Card --}}
    <div class="card">
        <div class="card-header" style="padding:14px 18px;">
            <div class="card-header-title">Category <span style="color:var(--accent);">*</span></div>
        </div>
        <div class="card-body" style="padding:16px 18px;">
            <select id="category_id" name="category_id" class="form-control" required>
                <option value="">— Select Category —</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id', $blog->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="form-error" style="margin-top:6px;">{{ $message }}</div> @enderror
        </div>
    </div>

    {{-- Featured Image Card --}}
    <div class="card">
        <div class="card-header" style="padding:14px 18px;">
            <div class="card-header-title">Featured Image</div>
        </div>
        <div class="card-body" style="padding:16px 18px; display:flex; flex-direction:column; gap:12px;">

            {{-- Image Upload --}}
            <div>
                <label class="form-label">Upload Image</label>
                <label id="image-drop-zone" for="image" style="
                    display:flex; flex-direction:column; align-items:center; justify-content:center;
                    border:2px dashed var(--border); border-radius:10px; padding:20px;
                    cursor:pointer; background:var(--surface-2); transition:border-color .15s;
                    gap:8px; text-align:center;">
                    <svg width="28" height="28" fill="none" stroke="var(--ink-muted)" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    <span style="font-size:.82rem; color:var(--ink-muted);">Click to upload or drag & drop</span>
                    <span style="font-size:.75rem; color:var(--ink-muted);">JPEG, PNG, WebP — max 2 MB</span>
                </label>
                <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp"
                    style="display:none;" onchange="handleImageUpload(this)">
                @error('image') <div class="form-error" style="margin-top:6px;">{{ $message }}</div> @enderror
            </div>

            {{-- Image preview --}}
            <div id="img-preview-wrap" class="img-preview-wrap" style="{{ $blog->image ? '' : 'display:none;' }}">
                @if ($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" alt="Current image">
                @endif
            </div>
            <div id="no-image-text" style="{{ $blog->image ? 'display:none;' : '' }} font-size:.78rem; color:var(--ink-muted); text-align:center;">
                No image selected
            </div>

            {{-- Or use URL --}}
            <div style="position:relative; text-align:center; margin:4px 0;">
                <hr style="border:none; border-top:1px solid var(--border);">
                <span style="position:absolute; top:-10px; left:50%; transform:translateX(-50%);
                    background:var(--surface); padding:0 10px; font-size:.77rem; color:var(--ink-muted); white-space:nowrap;">
                    OR provide a URL
                </span>
            </div>

            <div>
                <label class="form-label" for="image_url">Image URL</label>
                <input id="image_url" type="url" name="image_url" class="form-control"
                    placeholder="https://example.com/image.jpg"
                    value="{{ old('image_url', (!$blog->image && filter_var($blog->image ?? '', FILTER_VALIDATE_URL)) ? $blog->image : '') }}"
                    oninput="previewImageUrl(this.value)">
                <div class="form-hint">If both are set, the uploaded file takes priority.</div>
            </div>

            {{-- Remove existing image --}}
            @if ($blog->image)
            <div>
                <label class="toggle-wrap" style="cursor:pointer;">
                    <input type="checkbox" name="remove_image" value="1"
                        style="width:16px; height:16px; accent-color:var(--accent);">
                    <span style="font-size:.82rem; color:var(--ink-soft);">Remove current image</span>
                </label>
            </div>
            @endif
        </div>
    </div>

</div>
</div>

@push('styles')
<style>
#image-drop-zone:hover { border-color: var(--accent); background: var(--accent-soft); }
#image-drop-zone.drag-over { border-color: var(--accent); background: var(--accent-soft); }
</style>
@endpush

@push('scripts')
{{-- TinyMCE Open Source CDN (No API key required) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#content',
    plugins: 'lists link image table code fullscreen autoresize wordcount',
    toolbar: 'undo redo | bold italic underline strikethrough | h2 h3 | bullist numlist | link image | table | code fullscreen',
    toolbar_mode: 'wrap',
    min_height: 420,
    skin: 'oxide',
    content_css: 'default',
    menubar: false,
    branding: false,
    promotion: false,
    images_upload_handler: function(blobInfo, progress) {
        return new Promise(function(resolve, reject) {
            const formData = new FormData();
            formData.append('image', blobInfo.blob(), blobInfo.filename());
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                url: '{{ route("admin.blogs.store") }}', // ideally a dedicated upload route
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(resp) { resolve(resp.location || ''); },
                error: function() { reject('Upload failed'); }
            });
        });
    },
    setup: function(editor) {
        editor.on('change keyup paste', function() {
            editor.save(); // Sync content to textarea on every keystroke/change
        });
    }
});

// Character counter for excerpt
const excerptTA = document.getElementById('short_description');
const excerptCount = document.getElementById('excerpt-count');
if (excerptTA && excerptCount) {
    function updateCount() {
        const len = excerptTA.value.length;
        excerptCount.textContent = len + ' / 500';
        excerptCount.style.color = len > 450 ? '#dc2626' : 'var(--ink-muted)';
    }
    excerptTA.addEventListener('input', updateCount);
    updateCount();
}

// Drag-and-drop on the label
const dropZone = document.getElementById('image-drop-zone');
const fileInput = document.getElementById('image');
if (dropZone && fileInput) {
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.classList.add('drag-over');
    });
    dropZone.addEventListener('dragleave', function() {
        dropZone.classList.remove('drag-over');
    });
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('drag-over');
        if (e.dataTransfer.files.length > 0) {
            fileInput.files = e.dataTransfer.files;
            handleImageUpload(fileInput);
        }
    });
}

function handleImageUpload(input) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];
    if (file.size > 2 * 1024 * 1024) {
        alert('Image too large. Max 2 MB allowed.');
        input.value = '';
        return;
    }
    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById('img-preview-wrap');
        preview.style.display = 'flex';
        preview.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
        document.getElementById('no-image-text').style.display = 'none';
        document.getElementById('image_url').value = '';
    };
    reader.readAsDataURL(file);
}

function previewImageUrl(url) {
    if (!url) return;
    const preview = document.getElementById('img-preview-wrap');
    preview.style.display = 'flex';
    preview.innerHTML = '<img src="' + url + '" style="width:100%;height:100%;object-fit:cover;" onerror="this.parentElement.style.display=\'none\'">';
    document.getElementById('no-image-text').style.display = 'none';
}
</script>
@endpush

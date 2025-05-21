@extends('admin.layout')

@section('title', 'Modifier l\'Article')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Modifier l'Article</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.blog.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $post->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Catégorie</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" 
                            id="category_id" name="category_id">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ (old('category_id', $post->category_id) == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="excerpt" class="form-label">Extrait</label>
                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                              id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
                    @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Contenu</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" name="content" rows="10" required>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    @if($post->image)
                        <div class="current-image mb-2">
                            <p>Image actuelle :</p>
                            <img src="{{ asset($post->image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    @endif
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <p>Nouvelle image :</p>
                        <img src="" alt="Image Preview" class="img-thumbnail" style="max-height: 200px;">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour l'article</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '#content',
        height: 400,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic backcolor | \
                alignleft aligncenter alignright alignjustify | \
                bullist numlist outdent indent | removeformat | help'
    });

    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#imagePreview img').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection 
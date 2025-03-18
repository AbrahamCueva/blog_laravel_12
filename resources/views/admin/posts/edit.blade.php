<x-layouts.app>
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">
            Dashboard
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.posts.index')">
            Posts
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            Editar
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="card">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <flux:input label="Título" name="title" value="{{ old('title', $post->title) }}" class="@error('title') is-invalid @enderror" placeholder="Escribe el título del post" />
            <flux:input label="Slug" name="slug" value="{{ old('slug', $post->slug) }}" readonly class="@error('slug') is-invalid @enderror" placeholder="Escribe el slug del post" />
            <flux:select wire:model="industry" name="category_id" label="Seleccionar categoría" 
                placeholder="Seleccionar categoría..." class="@error('category_id') is-invalid @enderror">
                @foreach ($categories as $category)
                    <flux:select.option :selected="$category->id == old('category_id', $post->category_id)" value="{{ $category->id }}">
                        {{ $category->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
            <flux:textarea label="Resumen" name="excerpt" class="@error('excerpt') is-invalid @enderror" rows="3">
                {{ old('excerpt', $post->excerpt) }}
            </flux:textarea>
            <flux:textarea label="Contenido" name="content" class="@error('content') is-invalid @enderror" rows="8">
                {{ old('content', $post->content) }}
            </flux:textarea>
            <div class="flex space-x-3">
                <label class="flex items-center">
                    <input type="radio" name="is_published" value="0" 
                        @checked(old('is_published', $post->is_published) == 0)
                        class="@error('is_published') is-invalid @enderror">
                    <span class="ml-1">No publicado</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="is_published" value="1" 
                        @checked(old('is_published', $post->is_published) == 1)
                        class="@error('is_published') is-invalid @enderror">
                    <span class="ml-2">Publicado</span>
                </label>
            </div>
            <div class="flex justify-end">
                <flux:button variant="primary" type="submit">
                    <i class="fa-solid fa-pen-to-square"></i>
                </flux:button>
            </div>
        </form>
    </div>
    @push('js')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const nameInput = document.querySelector("input[name='title']");
                const slugInput = document.querySelector("input[name='slug']");
    
                nameInput.addEventListener("input", function() {
                    let slug = nameInput.value
                        .normalize("NFD").replace(/[\u0300-\u036f]/g, '') // Elimina acentos
                        .toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')  
                        .replace(/\s+/g, '-')         
                        .replace(/-+/g, '-');         
    
                    slugInput.value = slug;
                });
            });
        </script>
    @endpush
</x-layouts.app>
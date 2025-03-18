<x-layouts.app>
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">
            Dashboard
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.posts.index')">
            Posts
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            Nuevo
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="card">
        <form action="{{ route('admin.posts.store') }}" method="POST" class="space-y-4">
            @csrf
            <flux:input label="Título" name="title" value="{{ old('title') }}" class="@error('title') is-invalid @enderror" placeholder="Escribe el título del post" />
            <flux:input label="Slug" name="slug" value="{{ old('slug') }}" readonly class="@error('slug') is-invalid @enderror" placeholder="Escribe el slug del post" />
            <flux:select wire:model="industry" name="category_id" label="Seleccionar categoría" 
                placeholder="Seleccionar categoría..." class="@error('category_id') is-invalid @enderror">
                @foreach ($categories as $category)
                    <flux:select.option :selected="$category->id == old('category_id')" value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                @endforeach
            </flux:select>
            <div class="flex justify-end">
                <flux:button variant="primary" type="submit">
                    <i class="fa-solid fa-plus"></i>
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
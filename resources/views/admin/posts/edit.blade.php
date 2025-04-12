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

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="relative mb-2">
            {{-- <img class="w-full aspect-video object-cover object-center" src="https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg" alt=""> --}}
            <img id="imgPreview" class="w-full aspect-video object-cover object-center rounded" 
                src="{{ $post->image_path ? asset($post->image_path) : 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg' }}" 
                alt="">
            <div class="absolute top-8 right-8">
                <label class="bg-white p-2 rounded-full cursor-pointer hover:bg-gray-100">
                    Cambiar imágen
                    <input type="file" class="hidden" name="image" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                </label>
            </div>
        </div>

        <div class="card space-y-4">
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
            <div>
                <p class="txt-sm font-medium mb-1">Etiquetas</p>
                <ul>
                    @foreach ($tags as $tag)
                    <li>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="tags[]" 
                                value="{{ $tag->id }}"
                                class="@error('tags') is-invalid @enderror"
                                @checked(in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())))>
                            <span>{{ $tag->name }}</span>
                        </label>
                    </li>                    
                    @endforeach
                </ul>
            </div>
            <div>
                <p class="txt-sm font-medium mb-1">Estado</p>
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
            </div>
            <div class="flex justify-end">
                <flux:button variant="primary" type="submit">
                    <i class="fa-solid fa-pen-to-square"></i>
                </flux:button>
            </div>
        </div>
    </form>
</x-layouts.app>
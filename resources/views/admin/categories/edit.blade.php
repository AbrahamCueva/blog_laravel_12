<x-layouts.app>
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">
            Dashboard
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.categories.index')">
            Categorías
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            Editar
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="card">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <flux:input label="Nombre" name="name" class="@error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" placeholder="Escribe el nombre de la categoría" />
            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">
                    <i class="fa-solid fa-pen-to-square"></i>
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>
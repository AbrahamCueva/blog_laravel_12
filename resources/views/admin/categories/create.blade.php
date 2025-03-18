<x-layouts.app>
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">
            Dashboard
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.categories.index')">
            Categorías
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            Nuevo
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="card">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <flux:input class="@error('name') is-invalid @enderror" label="Nombre" name="name" value="{{ old('name') }}" placeholder="Escribe el nombre de la categoría" />
            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">
                    <i class="fa-solid fa-plus"></i>
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>
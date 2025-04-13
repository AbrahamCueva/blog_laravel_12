<x-layouts.public>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-12 text-center">Nuestros Posts</h1>

        <ul class="grid md:grid-cols-2 gap-10">
            @foreach ($posts as $post)
                <li>
                    <article class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 h-full flex flex-col group">
                        <div class="relative overflow-hidden rounded-t-2xl">
                            <a href="{{ route('posts.show', $post) }}">
                                {{-- Imagen principal --}}
                                <img 
                                    class="h-64 w-full object-cover object-center transform transition-transform duration-500 group-hover:scale-105 rounded-t-2xl" 
                                    src="{{ $post->image }}" 
                                    alt="Imagen del post">

                                {{-- Overlay SOLO en desktop y SOLO al hacer hover --}}
                                <div class="absolute inset-0 hidden md:flex group-hover:flex items-center justify-center transition-opacity duration-800">
                                    <div class="absolute inset-0 group-hover:block hidden">
                                        <img 
                                            src="{{ $post->image }}" 
                                            class="w-full h-full object-cover object-center blur-md brightness-90 scale-105 rounded-t-2xl" 
                                            alt="">
                                    </div>
                                    <h2 class="relative text-black text-xl md:text-2xl font-semibold px-4 text-center z-10 drop-shadow-md transform transition-all duration-500 group-hover:translate-y-1 group-hover:opacity-100 opacity-0">
                                        {{ $post->title }}
                                    </h2>
                                </div>
                            </a>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            {{-- Título visible en mobile --}}
                            <h3 class="text-xl font-bold text-gray-800 mb-2 md:hidden">{{ $post->title }}</h3>

                            <p class="text-gray-600 text-base leading-relaxed line-clamp-4 mb-4 transition-colors duration-300 group-hover:text-gray-800">
                                {{ $post->excerpt }}
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('posts.show', $post) }}" 
                                   class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:underline hover:gap-3 transition-all duration-200">
                                    Leer más 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                </li>
            @endforeach
        </ul>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</x-layouts.public>

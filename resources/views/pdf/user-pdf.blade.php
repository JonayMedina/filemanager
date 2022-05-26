<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- {{ dd(asset($file->path)) }} --}}
                @if ($file)
                    <a href="{{ $file->full_url }}">
                        <h1>Ver Pdf Disponible</h1>
                    </a>
                    <iframe width="100%" height="900px" src="{{ asset($file->full_url) }}" frameborder="0"></iframe>
                    {{-- <iframe width="100%" height="80vh" src="https://docs.google.com/viewer?url=http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf&embedded=true"  frameborder="0"></iframe> --}}
                @else
                    <h1>No tiene archivos disponibles todavia</h1>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

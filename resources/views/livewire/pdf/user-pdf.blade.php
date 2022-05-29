<x-slot name="header">
    <h1 class="text-gray-900">Home</h1>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if (asset('pdf/' . $user->username . '.pdf'))

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    @if ($checked)
                        <h1>Documento Aceptado!! Gracias</h1>
                    @else
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="acceptPdf({{ $user->id }})" type="button"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-800 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">Aceptar!!</button>
                        </span>
                    @endif

                </div>
                {{-- <button class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 my-3">
                    Agregar Nuevo</button> --}}

                <iframe width="100%" height="900px" src="{{ asset('pdf/' . $user->username . '.pdf') }}"
                    frameborder="0"></iframe>
                {{-- <iframe width="100%" height="80vh" src="https://docs.google.com/viewer?url=http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf&embedded=true"  frameborder="0"></iframe> --}}
            @else
                <h1>No tiene archivos disponibles todavia</h1>
            @endif
        </div>
    </div>
</div>

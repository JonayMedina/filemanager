<x-slot name="header">
    <h1 class="text-gray-900">All Files</h1>
</x-slot>
<div class="py-12">
    <div class="max-w-7x1 mx-auto sm:px6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-w1 sm:rounded-lg px-4 py-4">
            <button wire:click="crear()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 my-3">
                Agregar Nuevo</button>
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-4 py-2">
                            ID
                        </th>
                        <th class="px-4 py-2">
                            Name
                        </th>
                        <th class="px-4 py-2">
                            URL
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <td class="border px-4 py-2">{{ $file->id }}</td>
                            <td class="border px-4 py-2">{{ $file->name }}</td>
                            <td class="border px-4 py-2">{{ $file->url }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

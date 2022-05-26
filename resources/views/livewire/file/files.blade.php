<x-slot name="header">
    <h1 class="text-gray-900">All Files</h1>
</x-slot>
<div class="py-12 max-w-2xl mx-auto">
    <div class="max-w-5x1 mx-auto sm:px6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-w1 sm:rounded-lg px-4 py-4">
            <button wire:click="create()" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 my-3">
                Agregar Nuevo</button>

            @if ($modal)
                @include('livewire.file.create')
            @endif
            <table class="table-fixed w-full text-sm text-left text-gray-500 dark:text-gray-40">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2"> Path </th>
                        <th class="px-4 py-2"> URL </th>
                        <th class="px-4 py-2">User</th>
                        <th class="px-4 py-2">ACCIONES</th>

                    </tr>
                </thead>
                <tbody>
                    @if ($files)

                        @foreach ($files as $file)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="border px-4 py-2">{{ $file->name }}</td>
                                <td class="border px-4 py-2">{{ $file->path }}</td>
                                <td class="border px-4 py-2">{{ $file->full_url }}</td>
                                <td class="border px-4 py-2">
                                    {{ $file->user ? $file->user->username . ' ' . $file->user->email : 'No Asginado' }}
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <button wire:click="edit({{ $file->id }})"
                                        class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4">Editar</button>
                                    <button wire:click="delete({{ $file->id }})"
                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4">Borrar</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <h1 class="text-gray-900">Files empty</h1>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>

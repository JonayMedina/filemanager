<x-slot name="header">
    <h1 class="text-gray-900">All Users</h1>
</x-slot>
<div class="py-12">
    <div class="max-w-5x1 mx-auto sm:px6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-w1 sm:rounded-lg px-4 py-4">
            <button wire:click="create()" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 my-3">
                Agregar Nuevo</button>

            @if ($modal)
                @include('livewire.user.create')
            @endif
            @if ($modal2)
                @include('livewire.user.edit-user')
            @endif
            <table class="table-fixed w-full text-sm text-left text-gray-500 dark:text-gray-40">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2"> Username </th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Checked</th>
                        <th class="px-4 py-2">ACCIONES</th>

                    </tr>
                </thead>
                <tbody>
                    @if ($users)

                        @foreach ($users as $user)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="border px-4 py-2">{{ $user->role == 1 ? 'Admin' : 'User' }}</td>
                                <td class="border px-4 py-2">{{ $user->name }}</td>
                                <td class="border px-4 py-2">{{ $user->username }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                <td class="border px-4 py-2">
                                    {{ $user->currentFileChecked ? 'Aceptado el ' . $user->currentFileChecked->created_at->format('H:i:s d/m/Y') : 'NO Checked' }}
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <button wire:click="edit({{ $user->id }})"
                                        class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4">Editar</button>
                                    <button wire:click="delete({{ $user->id }})"
                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4">Borrar</button>
                                </td>
                            </tr>
                        @endforeach
                        {{ $users->links() }}
                    @else
                        <h1 class="text-gray-900">Users empty</h1>
                    @endif

                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>

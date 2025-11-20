<x-admin-layout>
    <x-slot name="title">Users</x-slot>

    <div class="bg-white p-6 rounded shadow">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-semibold">Users</h1>

            <a href="{{ route('admin.users.create') }}"
                class="px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white rounded">
                + Add User
            </a>
        </div>

        <table id="users-table" class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Role</th>
                    <th class="p-3">Created</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3">{{ $user->phone ?? '-' }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm
                                {{ $user->role === 'admin' ? 'bg-purple-200 text-purple-800' : 'bg-gray-200 text-gray-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="p-3">{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                                class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                onsubmit="return confirm('Delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- DataTables --}}
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable();
        });
    </script>
</x-admin-layout>

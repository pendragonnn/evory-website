<x-admin-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        
        <form action="{{ $action }}" method="POST">
            @csrf
            @method($method)

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Name -->
                <div>
                    <label class="font-medium">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full mt-1 border rounded p-2" required>
                </div>

                <!-- Email -->
                <div>
                    <label class="font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full mt-1 border rounded p-2" required>
                </div>

                <!-- Phone -->
                <div>
                    <label class="font-medium">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full mt-1 border rounded p-2">
                </div>

                <!-- Role -->
                <div>
                    <label class="font-medium">Role</label>
                    <select name="role" class="w-full mt-1 border rounded p-2">
                        <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>
                            Customer
                        </option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                    </select>
                </div>

                <!-- Password -->
                <div class="md:col-span-2">
                    <label class="font-medium">Password  
                        @if($method === 'PUT')
                            <span class="text-gray-500 text-sm">(leave blank to keep current)</span>
                        @endif
                    </label>
                    <input type="password" name="password" 
                        class="w-full mt-1 border rounded p-2"
                        {{ $method === 'POST' ? 'required' : '' }}>
                </div>

            </div>

            <div class="mt-6">
                <button class="px-5 py-2 bg-purple-700 hover:bg-purple-800 text-white rounded">
                    {{ $method === 'POST' ? 'Create User' : 'Update User' }}
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>

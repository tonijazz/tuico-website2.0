@extends('layouts.app')

@section('title', 'Join Us')

@section('content')
    <div class="max-w-3xl mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Join Us</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('join-us.store') }}" method="POST" class="space-y-4">
            @csrf
 <div>

                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="workplace" class="block text-sm font-medium text-gray-700">Workplace</label>
                <input type="text" name="workplace" id="workplace" value="{{ old('workplace') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>


            <div>
                <label for="region_id" class="block text-sm font-medium text-gray-700">Office</label>
               <select name="region_id" id="region_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select an office</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
                @error('region_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('message') }}</textarea>
                @error('message') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700">
                    Send Message
                </button>
            </div>
        </form>
    </div>
@endsection

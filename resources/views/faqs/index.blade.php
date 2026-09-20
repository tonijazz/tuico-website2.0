@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
    <div class="max-w-3xl mx-auto p-8">
        <h2 class="text-2xl font-bold mb-4">Frequently Asked Questions</h2>

        @foreach ($categories as $category)
            <h3 class="text-lg font-semibold mt-6 mb-2">{{ $category->name }}</h3>

            @foreach ($category->faqs as $faq)
                <div x-data="{ open: false }" class="border-b py-2">
                    <button @click="open = !open" class="w-full text-left font-semibold">
                        {{ $faq->question }}
                    </button>
                    <div x-show="open" class="text-gray-600 mt-2">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
@endsection

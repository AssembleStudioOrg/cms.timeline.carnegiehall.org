@php
    $authors = App\Models\Author::ordered()->get();
@endphp
<div class="prose">
    <h4>All Authors</h4>
    <p class="space-y-1 text-xs">
        @foreach ($authors as $author)
            <span class="inline-flex py-1 px-3 bg-white border border-gray-300 rounded-full">{{ $author->title }}
                (#{{ $author->id }})
            </span>
        @endforeach
    </p>
</div>

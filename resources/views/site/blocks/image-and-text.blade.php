@php
    $image = $block->imageAsArray('image', 'desktop');
@endphp

<div class="flex justify-between">
    <div class="prose">
        {!! $block->input('text') ?? '(empty)' !!}
    </div>
    <div class="text-xs text-gray-500">
        @if (isset($image['src']))
            <div><img src="{{ $image['src'] }}" class="max-h-[200px] max-w-[400px]" /></div>
        @endif
        <div class="prose">{!! $block->input('image_caption') ?? '(empty)' !!}</div>
        <div>Credit: {!! $block->input('image_credit') ?? '(empty)' !!}</div>
        <div>Credit link: {!! $block->input('image_credit_link') ?? '(empty)' !!}</div>
    </div>
</div>

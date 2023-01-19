@php
    $image = $block->imageAsArray('image', 'desktop');
@endphp

<div class="flex justify-between pb-10">
    <div class="text-xs text-gray-500">
        @if (isset($image['src']))
            <div><img src="{{ $image['src'] }}" class="max-h-[200px] max-w-[400px]" /></div>
        @endif
        @if ($block->input('vimeo_url'))
            <div>Vimeo URL: {{ $block->input('vimeo_url') }}</div>
        @endif
        @if ($block->input('youtube_url'))
            <div>Youtube URL: {{ $block->input('youtube_url') }}</div>
        @endif
        @if ($block->input('video'))
            <div>
                <div>Video file URL: {{ $block->input('video') }}</div>
                <div class="text-xs">(Not recommended.)</div>
            </div>
        @endif
        <div class="prose">
            <div class="text-xs">{!! $block->input('caption') ?? '(empty)' !!}</div>
        </div>
        <div>Credit: {{ $block->input('credit') ?? '(empty)' }}</div>
        <div>Credit link: {{ $block->input('credit_link') ?? '(empty)' }}</div>
    </div>
</div>

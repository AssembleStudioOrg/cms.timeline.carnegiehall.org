<div>
    <div class="prose">
        <div class="text-xl">
            {!! $block->input('quote') ?? '(empty)' !!}
        </div>
    </div>
    <div class="text-xs text-gray-500">
        <div>Person: {!! $block->input('person') ?? '(empty)' !!}</div>
        <div>Title: {!! $block->input('title') ?? '(empty)' !!}</div>
    </div>
</div>

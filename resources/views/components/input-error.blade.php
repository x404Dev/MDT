@props(['messages'])

@if ($messages)
    <ul style="color: rgb(255, 86, 86); " {{ $attributes->merge(['class' => 'space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

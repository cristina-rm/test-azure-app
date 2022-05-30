@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'validation-error text-sm text-red-600']) }}>{{ $message }}</p>
@enderror

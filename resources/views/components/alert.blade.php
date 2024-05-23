{{-- make alert error with bootstrap --}}
@props(['color' => 'danger'])
<div class="alert alert-{{$color}}">
    {{ $slot }}
</div>

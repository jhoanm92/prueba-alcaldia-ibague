{{-- text validation color red component --}}
@props(['field' => ''])

@error($field)
    <div class="text-danger">
        {{$message}}
    </div>
@enderror

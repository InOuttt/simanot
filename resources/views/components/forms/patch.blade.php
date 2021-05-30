<form method="post" enctype="multipart/form-data" {{ $attributes->merge(['action' => '#', 'class' => 'form-horizontal']) }} >
    @csrf
    @method('patch')

    {{ $slot }}
</form>

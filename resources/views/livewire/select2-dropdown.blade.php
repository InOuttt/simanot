
<div>

    <div wire:ignore class="parent-select2">
        <!-- <select name="notaris_id" class="form-control" id="select2-dropdown">
        <option></option>
            @foreach($notaris as $key => $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select> -->
        @if (!empty($oldData))
            <input type="text" hidden name="hidden-notaris_id" id="hidden-notaris_id" value="{{$oldData->id}}"/>
        @endif
        <select name="notaris_id" class="form-control select2" id="select2-dropdown">
            @if (!empty($oldData))
                <option value="{{$oldData->id}}">{{$oldData->nama}}</option>
            @endif
        </select>
    </div>

</div>

@push('scripts')

<script>
$(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Pilih Notaris',
            minimumInputLength: -1,
            ajax: {
                url: '/notaris/autocomplete',
                dataType: 'json',
                // delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.nama,
                                id: item.id
                            }
                        })
                    };
                },
                open: function () {
                    $('input.select2-search__field')[0].focus()
                }
            },
            cache: true
        }).val($('#hidden-notaris_id').val()).trigger('change');
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });


    });

</script>

@endpush
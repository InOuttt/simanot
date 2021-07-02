
<div>

<div wire:ignore class="parent-select2">
    <select name="nama_debitur" class="form-control select2" id="select2-debitur">
    </select>
</div>

</div>

@push('scripts')

<script>
$(document).ready(function () {
    $('#select2-debitur').select2({
        placeholder: 'Cari Debitur',
        minimumInputLength: -1,
        ajax: {
            url: '/ajax/akta/debitur',
            dataType: 'json',
            // delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nama_debitur,
                            id: item.nama_debitur
                        }
                    })
                };
            },
            open: function () {
                $('input.select2-search__field')[0].focus()
            }
        },
        cache: true
    });
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });


});

</script>

@endpush
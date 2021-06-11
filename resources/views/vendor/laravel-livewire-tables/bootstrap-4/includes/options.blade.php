@if ($paginationEnabled || $searchEnabled)

    @if ((!empty($searchDebitur) && $searchNotaris) && (!empty($searchDebitur) && $searchDebitur))
    <div class="row mb-4">    
        <label for="nama_notaris" class="col-md-2 col-form-label">Nama Notaris</label>
        <div class="col-md-4"> 
            <input
                @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="nama_notaris" @endif
                @if ($searchUpdateMethod === 'lazy') wire:model.lazy="search" @endif
                @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
                class="form-control"
                type="text"
                placeholder="nama notaris"
            />
        </div>
        <label for="nama_notaris" class="col-md-2 col-form-label">Nama Debitur</label>
        <div class="col-md-4 input-group"> 
            <input
                @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="nama_debitur" @endif
                @if ($searchUpdateMethod === 'lazy') wire:model.lazy="search" @endif
                @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
                class="form-control"
                type="text"
                placeholder="nama debitur"
            />
        </div>
    </div>
    <div class="row mb-4">    
        <label for="nama_notaris" class="col-md-2 col-form-label">Status Dokumen</label>
        <div class="col-md-4"> 
            <select
                @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="status" @endif
                class="form-control"
            >
                <option value="0">Belum Diterima</option>
                <option value="1">Diterima</option>
                <option value="2">Koreksi</option>
            </select>
        </div>
    </div>
    @endif

    @if(!empty($searchTagihan) && $searchTagihan)
        <div class="row mb-4">    
            <label for="nama_notaris" class="col-md-2 col-form-label">Bulan</label>
            <div class="col-md-4"> 
                <input name="tmp_bulan" id="tmp_bulan" value="{{$bulan}}" hidden>
                <select name="bulan" class="form-control" wire:model.debounce.{{ $searchDebounce }}ms="bulan" id="select-bulan">
                    @if(!empty($allMonth) && $allMonth)
                        <option id="opt-bulan-0" value="null" >{{__('All')}}</option>
                    @endif
                    @for($i=1; $i < 13; $i++)
                        <option id="opt-bulan-{{$i}}" value="{{$i}}" >{{listMonth()[$i]}}</option>
                    @endfor
                </select>
            </div>
            <label for="nama_notaris" class="col-md-2 col-form-label">Tahun</label>
            <div class="col-md-4"> 
                <input name="tmp_tahun" id="tmp_tahun" value="{{$tahun}}" hidden>
                <select name="tahun" class="form-control" wire:model.debounce.{{ $searchDebounce }}ms="tahun" id="select-tahun">
                    @for($i=2010; $i<=date('Y'); $i++)
                        <option id="opt-tahun-{{$i}}" value="{{$i}}" >{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="row mb-4">
            @if(!empty($showStatusAktaSearch) && $showStatusAktaSearch)

            <label for="nama_notaris" class="col-md-2 col-form-label">Status Akta</label>
            <div class="col-md-4"> 
                <div class="form-check form-check-inline">
                    <input name="status" class="form-check-input" type="radio" wire:model.debounce.{{ $searchDebounce }}ms="status" id="flexRadioDefault1" 
                        value="0" {{$status == 0 ? 'checked' : ''}}
                    />
                    <label class="form-check-label" for="flexRadioDefault1">
                        Belum Terima
                    </label>
                    </div>
                    <div class="form-check">
                    <input name="status" class="form-check-input" type="radio" wire:model.debounce.{{ $searchDebounce }}ms="status" 
                        id="flexRadioDefault2" value="2" {{$status == 2 ? 'checked' : ''}}
                    />
                    <label class="form-check-label" for="flexRadioDefault2">
                        Koreksi
                    </label>
                </div>
            </div>
            @endif
            @if(!empty($showNotarisSearch) && $showNotarisSearch)

            <label for="nama_notaris" class="col-md-2 col-form-label">Nama Notaris</label>
            <div class="col-md-4 input-group"> 
                <input
                    @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="nama_notaris" @endif
                    @if ($searchUpdateMethod === 'lazy') wire:model.lazy="search" @endif
                    @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
                    class="form-control"
                    type="text"
                    placeholder="nama notaris"
                />
            </div>

            @endif
            @if(!empty($showClusterSearch) && $showClusterSearch)

            <label for="nama_notaris" class="col-md-2 col-form-label">Nama Cluster</label>
            <div class="col-md-4 input-group"> 
                <input
                    @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="nama_cluster" @endif
                    @if ($searchUpdateMethod === 'lazy') wire:model.lazy="search" @endif
                    @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
                    class="form-control"
                    type="text"
                    placeholder="nama cluster"
                />
            </div>

            @endif
        </div>
    @endif

    <div class="row mb-4">
        @if ($paginationEnabled && count($perPageOptions))
            <div class="col form-inline">
                @lang('laravel-livewire-tables::strings.per_page'): &nbsp;

                <select wire:model="perPage" class="form-control">
                    @foreach ($perPageOptions as $option)
                        <option>{{ $option }}</option>
                    @endforeach
                </select>
            </div><!--col-->
        @endif

        @if ($searchEnabled)
            <div class="col-md-4">
                @if ($clearSearchButton)
                    <div class="input-group">
                        @endif
                        <input
                            @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="search" @endif
                            @if ($searchUpdateMethod === 'lazy') wire:model.lazy="search" @endif
                            @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
                            class="form-control"
                            type="text"
                            placeholder="{{ __('laravel-livewire-tables::strings.search') }}"
                        />
                        @if ($clearSearchButton)
                            <div class="input-group-append">
                                <button class="{{ $clearSearchButtonClass }}" type="button" wire:click="clearSearch">@lang('laravel-livewire-tables::strings.clear')</button>
                            </div>
                    </div>
                @endif
            </div>
        @endif

        @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.export')
    </div><!--row-->
@endif

@push('scripts')

<script>
    $('#select-bulan').on('change', function() {
        var bulan = $('#tmp_bulan').val();
        $('#opt-bulan-'+bulan).prop('selected', false);
    })
    $('#select-tahun').on('change', function() {
        var tahun = $('#tmp_tahun').val();
        $('#opt-tahun-'+tahun).prop('selected', false);
    })
</script>

@endpush
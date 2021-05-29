@if ($paginationEnabled || $searchEnabled)

    @if ($searchNotaris || $searchDebitur)
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

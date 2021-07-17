@if (!empty($this->customHeaderKinerja) && $this->customHeaderKinerja==true)
<tr>
    <th rowspan="2" class="" id="" style="vertical-align: middle;">
        No.
    </th>
    <th style="vertical-align: middle;" rowspan="2" class="" id="" wire:click="sort('nama')">
        Nama Notaris
        <i class="text-muted fas fa-sort"></i>
    </th>
    <th style="vertical-align: middle;horizontal-align: middle;text-align: center;" colspan="3" class="" id="">
        Jumlah Oustanding Covernote
    </th>
</tr>
<tr>
    <th class="" id="">
        0 - 3 Bulan
    </th>
    <th class="" id="">
        3 - 6 Bulan
    </th>
                                            <th class="" id="">
      &gt; 6 Bulan
    </th>
</tr>
@else
<tr>
    @foreach($columns as $column)
        @if ($column->isVisible())
            @if($column->isSortable())
                <th
                    class="{{ $this->setTableHeadClass($column->getAttribute()) }}"
                    id="{{ $this->setTableHeadId($column->getAttribute()) }}"
                    @foreach ($this->setTableHeadAttributes($column->getAttribute()) as $key => $value)
                    {{ $key }}="{{ $value }}"
                    @endforeach
                    wire:click="sort('{{ $column->getAttribute() }}')"
                    style="cursor:pointer;"
                >
                    {{ $column->getText() }}

                    @if ($sortField !== $column->getAttribute())
                        {{ new \Illuminate\Support\HtmlString($sortDefaultIcon) }}
                    @elseif ($sortDirection === 'asc')
                        {{ new \Illuminate\Support\HtmlString($ascSortIcon) }}
                    @else
                        {{ new \Illuminate\Support\HtmlString($descSortIcon) }}
                    @endif
                </th>
            @else
                <th
                    class="{{ $this->setTableHeadClass($column->getAttribute()) }}"
                    id="{{ $this->setTableHeadId($column->getAttribute()) }}"
                    @foreach ($this->setTableHeadAttributes($column->getAttribute()) as $key => $value)
                        {{ $key }}="{{ $value }}"
                    @endforeach
                >
                    {{ $column->getText() }}
                </th>
            @endif
        @endif
    @endforeach
</tr>
@endif



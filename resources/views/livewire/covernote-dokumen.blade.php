<div>
    <div class="row ">
        <div class="col-md-1">
            <span>No.</span>
        </div>
        <div class="col-md-3">
            <span>File</span>
        </div>
        <div class="col-md-2">
            <span>Tanggal Terbit</span>
        </div>
        <div class="col-md-4">
            <span>Nomor Dokumen</span>
        </div>
    </div>

    </br>

        <div class=" add-input">
            <div class="row">
                <div class="col-md-1">
                    <span>1</span>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="nama" class="form-control" name="dokumen[1][nama]" wire:model="dokumen.0.nama" placeholder="Contoh: dokumen pertama covernote">
                        @error('nama.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="date" class="form-control date" placeholder="dd/mm/yyyy " name="dokumen[1][tanggal]" wire:model="dokumen.0.date">
                        @error('date.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="contoh: 6487/asdoi " name="dokumen[1][nomor]" wire:model="dokumen.0.nomor"  >
                        @error('nomor.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn text-white btn-info btn-sm" wire:click.prevent="add({{$i}})">Add</button>
                </div>
            </div>
        </div>

        @foreach($inputs as $key => $value)
            <div class=" add-input">
                <div class="row">
                    <div class="col-md-1">
                        <span>{{$value}}</span>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="dokumen[{{ $value }}][nama]" wire:model="dokumen.{{ $value }}.nama">
                            @error('nama.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" name="dokumen[{{ $value }}][tanggal]" class="form-control date" placeholder="dd/mm/yyyy" wire:model="dokumen.{{ $value }}.date" value="<?php echo date('Y-m-d'); ?>" >
                            @error('dokumen.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="dokumen[{{ $value }}][nomor]" class="form-control" placeholder="contoh: 6487/asdoi" wire:model="dokumen.{{ $value }}.nomor" >
                            @error('dokumen.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">remove</button>
                        <button class="btn text-white btn-info btn-sm" wire:click.prevent="add({{$i}})">Add</button>
                    </div>
                </div>
            </div>
        @endforeach

</div>

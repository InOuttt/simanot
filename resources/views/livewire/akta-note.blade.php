<div>

        <div class=" add-input">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="date" class="form-control date" placeholder="dd/mm/yyyy " name="akta_note[]['tanggal']" wire:model="note.0.date">
                        @error('date.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="contoh: Notaris tidak memberi jawaban " name="akta_note[]['note']" wire:model="note.0.note"  value="<?php echo date('Y-m-d'); ?>" >
                        @error('note.0') <span class="text-danger error">{{ $message }}</span>@enderror
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" name="akta_note[]['tanggal']" class="form-control date" placeholder="dd/mm/yyyy" wire:model="note.{{ $value }}.date" value="<?php echo date('Y-m-d'); ?>" >
                            @error('note.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="akta_note[]['note']" class="form-control" placeholder="contoh: Notaris sudah memberi jawaban" wire:model="note.{{ $value }}.note" >
                            @error('note.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">remove</button>
                    </div>
                </div>
            </div>
        @endforeach

</div>

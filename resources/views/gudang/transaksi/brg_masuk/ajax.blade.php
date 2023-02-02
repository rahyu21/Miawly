@foreach ($ajax_barang as $d)
    <div class="form-group">
        <label for="">Harga</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-grup-text" id="basic-addon1">Rp</span>
            </div>
            <input type="text" class="form-control" id="harga" value="{{$d->harga}}" readonly required>
        </div>
    </div> 
@endforeach
@extends('layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Data Barang</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="#">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Data</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Barang</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Data Barang</h4>
                                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalAddUser">
                                        <i class="fa fa-plus"></i>
                                        Add Row
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no=1; @endphp
                                            @foreach ($barang as $row)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$row->nama_barang}}</td>
                                                <td>{{$row->nama_kategori}}</td>
                                                <td>Rp.{{number_format($row->harga)}}</td>
                                                <td>{{$row->stok}}Pcs</td>
                                                <td>
                                                    <a href="#modalEditBarang {{$row->id}}" data-toggle="modal" class="btn btn-primary btn-xs"><i class=" fa fa-edit"> Edit</i></a>
                                                    <a href="#modalHapusBarang {{$row->id}}" data-toggle="modal" class="btn btn-danger btn-xs"><i class=" fa fa-trash"> Hapus</i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>		
    </div>
    
    <!--Modal User-->
    <div class="modal fade" id="modalAddBarang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/barang/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" class="form-control" name="name" placeholder="Nama Barang ..." required>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="id_kategori" id="" class="form-control" required>
                                <option value="" hidden>-- Pilih Kategori</option>
                                @foreach ($kategori as $p)
                                    <option value="{{$p->id}}">{{$p->nama_kategori}}</option> 
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                </div>
                                <input type="number" name="harga" class="form-control" placeholder="Harga ..." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="number" name="stok" class="form-control" placeholder="Stok ..." required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Pcs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Edit Data-->
    @foreach ($barang as $d)
        <div class="modal fade" id="modalEditBarang{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/barang/{{$d->id}}/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <input type="text" value="{{$d->nama_barang}}" class="form-control" name="nama_barang" placeholder="Nama Barang ..." required>
                            </div>
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="id_kategori" value="{{$d->nama_kategori}}" id="" class="form-control" required>
                                    <option value="{{$d->id_kategori}}">{{$d->nama_kategori}}</option>
                                    @foreach ($kategori as $p)
                                        <option value="{{$p->id}}">{{$p->nama_kategori}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="number"  value="{{$d->harga}}" name="harga" class="form-control" placeholder="Harga ..." required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="number"  value="{{$d->stok}}" name="stok" class="form-control" placeholder="Stok ..." required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Pcs</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!--Hapus Data-->
    @foreach ($barang as $g)
        <div class="modal fade" id="modalHapusBarang{{$g->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/barang/{{$d->id}}/destroy" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" value="{{$d->id}}" name="id" required>
                                <div class="form-group">
                                    <h4>Apakah Anda Ingin Menghapus Data Ini?</h4>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
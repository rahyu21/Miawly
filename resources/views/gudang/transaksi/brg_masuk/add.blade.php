@extends('layout.layout')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Add Barang Masuk</h4>
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
                            <a href="#">Add</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Barang Masuk</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add Barang Masuk</div>
                            </div>
                            <form action="/brg_masuk/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    {{-- <input type="hidden" value="{{Auth::user()->id}}" name="id_user" required> --}}

                                    <div class="form-group">
                                        <label>No Barang Masuk</label>
                                        <input type="text" class="form-control" readonly value="{{'NBM-'.$kd}}" placeholder="No Barang Masuk..." name="no_brg_masuk" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tgl Masuk</label>
                                        <input type="date" class="form-control" name="tgl_brg_masuk" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <select name="id_barang" id="id_barang" class="form-control" required>
                                            <option value="" hidden="">-- Pilih Barang --</option>
                                            @foreach ($barang as $d)
                                            <option value="{{$d->id}}">{{$d->nama_barang}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="detail_barang">
                                        <div class="form-group">
                                            <label for="">Jumlah Barang</label>
                                            <div class="input-group mb-3">
                                                <input type="number" id="jml_brg_masuk" name="jml_brg_masuk" class="form-control" placeholder="Jumlah Barang ..." required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">Pcs</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Total</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" readonly name="total" id="total" class="form-control" placeholder="Total ..." required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                                    <a href="/brg_masuk" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>    

    <script src="/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="text/javascript">
        $(document).ready(function(){
            $("#jml_brg_masuk").change(function(){
                var jml_brg_masuk = $("#jml_brg_masuk")
                var harga = $("#harga")
                var total = parseInt(harga) + parseInt(jml_brg_masuk);
                $("#total").val(total);
            });
        });
    </script>
    <script src="text/javascript">
        $("#id_barang").change(function(){
            var id_barang = $("#id_barang").val();
            $.ajax({
                type:"GET",
                url: "/brg_masuk/ajax",
                data:"id_barang"+id_barang,
                cache:false,
                success:function(data){
                    $("#detai_barang").html(data);
                }
            });
        });
    </script>


@endsection
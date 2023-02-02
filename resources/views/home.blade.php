@extends('layout.layout')

@section('content')	
	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				<!-- Card -->
				<h4 class="page-title">Dashboard</h4>
				<!-- Card With Icon States Background -->
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="card card-stats card-round">
							<div class="card-body ">
								<div class="row align-items-center">
									<div class="col-icon">
										<div class="icon-big text-center icon-primary bubble-shadow-small">
											<i class="flaticon-users"></i>
										</div>
									</div>
									<div class="col col-stats ml-3 ml-sm-0">
										<div class="numbers">
											<p class="card-category">Data User</p>
											<h4 class="card-title"> {{$user}} </h4>
										</div>										
                                    </div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="card card-stats card-round">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-icon">
										<div class="icon-big text-center icon-info bubble-shadow-small">
											<i class="flaticon-interface-6"></i>
										</div>
									</div>
									<div class="col col-stats ml-3 ml-sm-0">
										<div class="numbers">
											<p class="card-category">Data Barang</p>
											<h4 class="card-title"> {{$barang}} </h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="card card-stats card-round">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-icon">
										<div class="icon-big text-center icon-success bubble-shadow-small">
											<i class="flaticon-graph"></i>
										</div>
									</div>
									<div class="col col-stats ml-3 ml-sm-0">
										<div class="numbers">
											<p class="card-category">Data Kateegori</p>
											<h4 class="card-title"> {{$kategori}} </h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-md-6">
						<div class="card card-stats card-round">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-icon">
										<div class="icon-big text-center icon-secondary bubble-shadow-small">
											<i class="flaticon-success"></i>
										</div>
									</div>
									<div class="col col-stats ml-3 ml-sm-0">
										<div class="numbers">
											<p class="card-category">Data Barang Masuk Hari Ini</p>
											<h4 class="card-title"> {{$brg_masuk_today}} </h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="card card-stats card-round">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-icon">
										<div class="icon-big text-center icon-secondary bubble-shadow-small">
											<i class="fa fa-truck"></i>
										</div>
									</div>
									<div class="col col-stats ml-3 ml-sm-0">
										<div class="numbers">
											<p class="card-category">Data Barang Keluar Hari Ini</p>
											<h4 class="card-title"> {{$brg_keluar_today}} </h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Jumlah Barang Masuk Dan Keluar</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="doughnutChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Barang Masuk Dan Keluar Perbulan</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>		
	</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Jumlah Keseluruhan --}}
    <script>
        const ctx = document.getElementById('doughnutChart');
        const doughnutChart = new Chart(ctx, {
            type : 'doughtnut',
            data : {
                labels : ['Barang Masuk', 'Barang Keluar'],
                datasets : [{
                    label : '# of Votes',
                    data : [ {{$brg_masuk}}, {{$brg_keluar}} ],
                    backgroundColor : [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor : [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth : 1
                }]
            },
            option : {
                scales : {
                    y : {
                        beginAtZero : true
                    }
                }
            }
        });
    </script>

    {{-- Jumlah Perbualan --}}
    <script>
        const ctr = document.getElementById('barChart');
        const barChart = new Chart(ctr, {
            type : 'bar',
            data : {
                labels : ['Januari', 'Februari', 'Maret', 'April', 
                            'Mei', 'Juni', 'Juli', 'Agustus',
                            'September', 'Oktober', 'November', 'Desember'],
                datasets : [{
                    label : 'Barang Masuk',
                    data : [ {{$masuk_jan}}, {{$masuk_feb}}, {{$masuk_mar}}, {{$masuk_apr}},
                            {{$masuk_mei}}, {{$masuk_jun}}, {{$masuk_jul}}, {{$masuk_agt}}, 
                            {{$masuk_sep}}, {{$masuk_okt}}, {{$masuk_nov}},{{$masuk_des}} ],
                    backgroundColor : [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor : [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth : 1
                },
                {
                    label : 'Barang Keluar',
                    data : [ {{$keluar_jan}}, {{$keluar_feb}}, {{$keluar_mar}}, {{$keluar_apr}},
                            {{$keluar_mei}}, {{$keluar_jun}}, {{$keluar_jul}}, {{$keluar_agt}}, 
                            {{$keluar_sep}}, {{$keluar_okt}}, {{$keluar_nov}},{{$keluar_des}}  ],
                    backgroundColor : [
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor : [
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth : 1
                }]
            },
            option : {
                scales : {
                    y : {
                        beginAtZero : true
                    }
                }
            }
        });
    </script>

@endsection
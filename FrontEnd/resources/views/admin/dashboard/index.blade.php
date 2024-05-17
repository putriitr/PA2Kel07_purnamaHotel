@extends('admin.master')

@section('title')
    Selamat Datang {{ Auth::guard('admin')->user()->name }}
@endsection

@section('subtitle')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Surat</h3>
                            <p>Surat Pengantar KTP</p>
                        </div>
                        <div class="icon">
                            <i class="fa-regular fa-house fa-beat"></i>
                        </div>
                        {{-- <a href="{{route('admin.surat')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Saran</h3>
                            <p>Saran dari Masyarakat</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        {{-- <a href="{{route('admin.saran')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            {{-- <h3>{{$total_berita}}</h3> --}}
                            <p>Berita</p>
                        </div>
                        <div class="icon">
                            <i class="fa-regular fa-house fa-beat"></i>
                        </div>
                        {{-- <a href="{{ route('index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            {{-- <h3>{{$total_galery}}</h3> --}}
                            <p>Galery</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        {{-- <a href="{{Route('galery.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            {{-- <h3>{{$total_structure}}</h3> --}}
                            <p>Struktur Desa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        {{-- <a href="{{Route('structure.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            {{-- <h3>{{$total_pengumuman}}</h3> --}}
                            <p>Pengumuman</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        {{-- <a href="{{Route('pengumuman.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row (main row) -->
        </div>
    </section>
@endsection

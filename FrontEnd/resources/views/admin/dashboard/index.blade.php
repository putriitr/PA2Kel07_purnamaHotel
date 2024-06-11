@extends('admin.master')

@section('title')
    Selamat Datang {{ Auth::guard('admin')->user()->name }}
@endsection

@section('subtitle')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12">
                    <form method="GET" action="{{ route('dashboard') }}" id="filterForm">
                        <div class="form-group">
                            <label for="period">Pilih Periode</label>
                            <select name="period" id="period" class="form-control">
                                <option value="day" {{ $period == 'day' ? 'selected' : '' }}>Harian</option>
                                <option value="week" {{ $period == 'week' ? 'selected' : '' }}>Mingguan</option>
                                <option value="month" {{ $period == 'month' ? 'selected' : '' }}>Bulanan</option>
                                <option value="year" {{ $period == 'year' ? 'selected' : '' }}>Tahunan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">Pilih Tahun</label>
                            <select name="year" id="year" class="form-control">
                                @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                                    <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" id="monthGroup" style="{{ $period == 'month' ? 'display: block;' : 'display: none;' }}">
                            <label for="month">Pilih Bulan</label>
                            <select name="month" id="month" class="form-control">
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="weekGroup" style="{{ $period == 'week' ? 'display: block;' : 'display: none;' }}">
                            <label for="week">Pilih Minggu</label>
                            <select name="week" id="week" class="form-control">
                                @foreach (range(1, 52) as $w)
                                    <option value="{{ $w }}" {{ $week == $w ? 'selected' : '' }}>Minggu {{ $w }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <!-- Revenue Chart -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pendapatan Per {{ ucfirst($period) }}</h3>
                            <div class="btn-group float-right">
                                <button onclick="exportChart('revenueChart', 'image')"
                                    class="btn btn-secondary btn-sm ml-2">Export as Image</button>
                                <button onclick="exportChart('revenueChart', 'pdf')"
                                    class="btn btn-secondary btn-sm ml-2">Export as PDF</button>
                                <a href="{{ route('admin.exportExcel', ['type' => 'revenue', 'period' => $period]) }}"
                                    class="btn btn-secondary btn-sm ml-2">Export to Excel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="revenueChart" style="height:250px; min-height:250px"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Bookings Chart -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Jumlah Booking Per {{ ucfirst($period) }}</h3>
                            <div class="btn-group float-right">
                                <button onclick="exportChart('bookingChart', 'image')"
                                    class="btn btn-secondary btn-sm ml-2">Export as Image</button>
                                <button onclick="exportChart('bookingChart', 'pdf')"
                                    class="btn btn-secondary btn-sm ml-2">Export as PDF</button>
                                <a href="{{ route('admin.exportExcel', ['type' => 'booking', 'period' => $period]) }}"
                                    class="btn btn-secondary btn-sm ml-2">Export to Excel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="bookingChart" style="height:250px; min-height:250px"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Registration Chart -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Jumlah Registrasi Per {{ ucfirst($period) }}</h3>
                            <div class="btn-group float-right">
                                <button onclick="exportChart('registrationChart', 'image')"
                                    class="btn btn-secondary btn-sm ml-2">Export as Image</button>
                                <button onclick="exportChart('registrationChart', 'pdf')"
                                    class="btn btn-secondary btn-sm ml-2">Export as PDF</button>
                                <a href="{{ route('admin.exportExcel', ['type' => 'registration', 'period' => $period]) }}"
                                    class="btn btn-secondary btn-sm ml-2">Export to Excel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="registrationChart" style="height:250px; min-height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        document.getElementById('period').addEventListener('change', function () {
            const period = this.value;
            document.getElementById('monthGroup').style.display = (period === 'month') ? 'block' : 'none';
            document.getElementById('weekGroup').style.display = (period === 'week') ? 'block' : 'none';
        });

        // Revenue Chart
        var revenueCtx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(revenueCtx, {
            type: 'bar', // Change to bar chart type
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Pendapatan Per ' + "{{ ucfirst($period) }}",
                    data: @json($totals),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Booking Chart
        var bookingCtx = document.getElementById('bookingChart').getContext('2d');
        var bookingChart = new Chart(bookingCtx, {
            type: 'bar', // Change to bar chart type
            data: {
                labels: @json($bookingDates),
                datasets: [{
                    label: 'Jumlah Booking Per ' + "{{ ucfirst($period) }}",
                    data: @json($bookingCounts),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
                    fill: false,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Registration Chart
        var registrationCtx = document.getElementById('registrationChart').getContext('2d');
        var registrationChart = new Chart(registrationCtx, {
            type: 'bar', // Change to bar chart type
            data: {
                labels: @json($registrationDates),
                datasets: [{
                    label: 'Jumlah Registrasi Per ' + "{{ ucfirst($period) }}",
                    data: @json($registrationCounts),
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                    fill: false,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Function to export charts as images or PDFs
        function exportChart(chartId, format) {
            const chartElement = document.getElementById(chartId);

            html2canvas(chartElement).then(canvas => {
                const imgData = canvas.toDataURL('image/png');

                if (format === 'image') {
                    // Create a link element and trigger a download
                    const link = document.createElement('a');
                    link.href = imgData;
                    link.download = `${chartId}.png`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } else if (format === 'pdf') {
                    // Create a PDF and add the image to it
                    const {
                        jsPDF
                    } = window.jspdf;
                    const pdf = new jsPDF();
                    pdf.addImage(imgData, 'PNG', 10, 10);
                    pdf.save(`${chartId}.pdf`);
                }
            });
        }
    </script>
@endpush

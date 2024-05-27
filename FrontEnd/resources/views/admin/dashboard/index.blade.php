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
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="form-group">
                            <label for="period">Pilih Periode</label>
                            <select name="period" id="period" class="form-control">
                                <option value="day" {{ $period == 'day' ? 'selected' : '' }}>Per Hari</option>
                                <option value="week" {{ $period == 'week' ? 'selected' : '' }}>Per Minggu</option>
                                <option value="month" {{ $period == 'month' ? 'selected' : '' }}>Per Bulan</option>
                                <option value="year" {{ $period == 'year' ? 'selected' : '' }}>Per Tahun</option>
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
                                <button onclick="exportChart('revenueChart', 'image')" class="btn btn-secondary btn-sm ml-2">Export as Image</button>
                                <button onclick="exportChart('revenueChart', 'pdf')" class="btn btn-secondary btn-sm ml-2">Export as PDF</button>
                                <a href="{{ route('admin.exportExcel', ['type' => 'revenue', 'period' => $period]) }}" class="btn btn-secondary btn-sm ml-2">Export to Excel</a>
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
                                <button onclick="exportChart('bookingChart', 'image')" class="btn btn-secondary btn-sm ml-2">Export as Image</button>
                                <button onclick="exportChart('bookingChart', 'pdf')" class="btn btn-secondary btn-sm ml-2">Export as PDF</button>
                                <a href="{{ route('admin.exportExcel', ['type' => 'booking', 'period' => $period]) }}" class="btn btn-secondary btn-sm ml-2">Export to Excel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="bookingChart" style="height:250px; min-height:250px"></canvas>
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
        // Revenue Chart
        var revenueCtx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Pendapatan Harian',
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
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Jumlah Booking Harian',
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
                    const { jsPDF } = window.jspdf;
                    const pdf = new jsPDF();
                    pdf.addImage(imgData, 'PNG', 10, 10);
                    pdf.save(`${chartId}.pdf`);
                }
            });
        }
    </script>
@endpush

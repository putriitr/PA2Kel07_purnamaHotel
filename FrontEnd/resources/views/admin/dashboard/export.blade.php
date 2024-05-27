<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Revenue</th>
            <th>Bookings</th>
        </tr>
    </thead>
    <tbody>
        @foreach($revenueData as $revenue)
            <tr>
                <td>{{ $revenue->date }}</td>
                <td>{{ $revenue->total }}</td>
                <td>{{ $bookingData->firstWhere('date', $revenue->date)->count ?? 0 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!DOCTYPE html>
<html>
<head>
    <title>PDF Report</title>
    <style>
        /* Add your custom styles for the PDF */
    </style>
</head>
<body>
    <h1>Data Report</h1>
    <table>
        <thead>
            <tr>
                <th>Inspection ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Activity</th>
                <th>Inspection Address</th>
                <th>Notes</th>
                <th>Inspection Link</th>
            </tr>
        </thead>
        <tbody>
        @dd($formattedData)
            @foreach($formattedData as $data)
            <tr>
                <td>{{ $data['inspection_id'] }}</td>
                <td>{{ $data['date'] }}</td>
                <td>{{ $data['time'] }}</td>
                <td>{{ $data['activity'] }}</td>
                <td>{{ $data['inspection_address'] }}</td>
                <td>{!! $data['notes_link'] !!}</td>
                <td>{!! $data['inspection_link'] !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

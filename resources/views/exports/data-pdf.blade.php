<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Data</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Dashboard Data</h2>

    @if(!empty($data['gender']))
        <h3>Gender</h3>
        <table>
            <tr><th>Category</th><th>Value</th></tr>
            @foreach($data['gender'] as $item)
                <tr>
                    <td>{{ $item['category'] ?? 'N/A' }}</td>
                    <td>{{ $item['value'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    @if(!empty($data['organizations']))
        <h3>Organizations</h3>
        <table>
            <tr><th>Name</th><th>Count</th></tr>
            @foreach($data['organizations'] as $item)
                <tr>
                    <td>{{ $item['name'] ?? 'N/A' }}</td>
                    <td>{{ $item['count'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    @if(!empty($data['interests']))
        <h3>Interests</h3>
        <table>
            <tr><th>Name</th><th>Count</th></tr>
            @foreach($data['interests'] as $item)
                <tr>
                    <td>{{ $item['name'] ?? 'N/A' }}</td>
                    <td>{{ $item['count'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </table>
    @endif
</body>
</html>

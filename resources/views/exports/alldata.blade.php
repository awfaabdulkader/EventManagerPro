<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tickets Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f8f9fa;
            color: #333;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .table-container {
            width: 100%;
            overflow-x: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }
        th {
            background: #77520d;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        tr:hover {
            background: #e9ecef;
        }
    </style>
</head>
<body>
    <h1>Form Tickets Data</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Civility</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Organization</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Job</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $ticket)
                <tr>
                    <td> {{ $ticket->id }}</td>
                    <td>                        {{ $ticket->civility }} </td>
                    <td>                        {{ $ticket->firstName }}</td>
                    <td>                        {{ $ticket->lastName }}</td>
                    <td>                        {{ $ticket->organization ?? 'N/A' }}</td>
                    <td>                        {{ $ticket->email }}</td>
                    <td>                        {{ $ticket->phone }}</td>
                    <td>                        {{ $ticket->job }}</td>
                @endforeach
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</body>
</html>

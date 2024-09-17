<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
        }
        ul {
            padding-left: 20px;
        }
        li {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
        }
        .status {
            font-weight: bold;
            color: #007BFF;
        }
        .header {
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Meeting Reservation Details</h1>
        </div>
        <p><strong>Room:</strong> {{ $reservation->room->name }}</p>
        <p><strong>Meeting Type:</strong> {{ $reservation->meeting_type }}</p>
        <p><strong>Platform:</strong> {{ $reservation->platform }}</p>
        <p><strong>Start Time:</strong> {{ $reservation->start_time }}</p>
         <p><strong>End Time:</strong> {{ $reservation->end_time }}</p>
        <p><strong>Subject:</strong> {{ $reservation->subject }}</p>
        <p><strong>Participants:</strong></p>
        <ul>
            @foreach(json_decode($reservation->participants) as $participant)
                <li>{{ $participant }}</li>
            @endforeach
        </ul>
        <p><strong>Status:</strong> <span class="status">{{ $reservation->status }}</span></p>
    </div>
</body>
</html>

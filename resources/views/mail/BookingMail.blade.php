<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
   

    <div style="text-align: center; background-color: white; padding: 20px; border-radius: 15px; border: 2px solid #ddd; max-width: 400px; margin: auto;">
        <h1>Dobrodošli na platformu za rezervisanje online termina - Beautify</h1>
        <p>Poštovani,<br>obaveštavamo vas da ste uspešno rezervisali termin</p>
        @php
            $time = $booking['time'][0] . $booking['time'][1]  . $booking['time'][2] . $booking['time'][3] . $booking['time'][4];
        @endphp
        <p><b>Vreme:</b> {{ $time }}h</p>
        <p><b>Datum:</b> {{ $booking['date'] }}</p>
    </div>
</body>
</html>
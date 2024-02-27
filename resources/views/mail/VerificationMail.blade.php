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
        <p>Klikom na dugme izvršićete verifikaciju mail-a,nakon čega možete rezervisati termin</p>
        <a href="{{ asset('http://localhost:5173/booking') }}"><button type="button" style="background-color: black; border-radius: 10px; border: none; color: white;font-size:28px;
        padding:10px;font-weight:700">Verifikacija</button>
        </a>
    </div>
</body>
</html>
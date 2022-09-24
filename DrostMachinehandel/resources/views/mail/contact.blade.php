<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Nieuw bericht op Drostmachinehandel.nl</h1>
    <br><br>
    <p><b>Naam:</b> {{ $details['firstname'] }} {{ $details['lastname'] }}</p>
    <p><b>Telefoonnummer:</b> {{ $details["phonenumber"] }}</p>
    <p><b>Email:</b> {{ $details["email"] }}</p>
    <p><b>Verzonden op:</b> {{ $details["currentTime"] }}</p>
    <p><b>Bericht:</b> {{ $details["message"] }}</p>
</body>
</html>
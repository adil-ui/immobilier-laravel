<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Bonjour {{ $user->name }}</h1>
    <a href="http://localhost:3000/réinitialiser-le-mot-de-passe/{{ $token }}">Réinitialiser votre mot de passe</a>
</body>

</html>
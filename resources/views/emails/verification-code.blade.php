<!DOCTYPE html>
<html>
<head>
    <title>Code de vérification</title>
</head>
<body>
    <h1>Bonjour {{ $user->prenom }},</h1>
    <p>Votre code de vérification est : <strong>{{ $code }}</strong></p>
    <p>Ce code expirera dans 10 minutes.</p>
</body>
</html>
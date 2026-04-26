<!DOCTYPE html>
<html>
<head>
    <title>Vos identifiants</title>
</head>
<body>
    <h1>Bienvenue {{ $user->prenom }} !</h1>
    <p>Votre compte a été créé avec succès.</p>
    <p>Voici vos identifiants de connexion :</p>
    <ul>
        <li><strong>Identifiant unique :</strong> {{ $user->identifiant_unique }}</li>
        <li><strong>Mot de passe temporaire :</strong> {{ $password }}</li>
    </ul>
    <p>Pour des raisons de sécurité, veuillez changer votre mot de passe dès votre première connexion.</p>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Gamos - Location de voitures haut de gamme</title>
</head>
<body>
    <header class="header">
        <div class="header-logo">
            <img src="uploads\logo\gamos2.jpeg.webp" alt="" class="logo">
            <div class="header-text">
                <h1>Gamos</h1>
                <p>Location de voitures haut de gamme</p>
            </div>
        </div>

        <?php if (!empty($_SESSION['email'])): ?>
            <nav class="header-nav">
                <ul class="nav-links">
                    <li><a href="login">Accueil</a></li>
                    <li><a href="home">Réserver</a></li>
                    <li><a href="profil">Mon Profil</a></li>
                    <li><a href="mesreservations">Mes réservations</a></li>
                    <li><a href="logout">Se déconnecter</a></li>
                </ul>
            </nav>
        <?php else: ?>
            <form method="post" class="header-login">
        <div class="login-row">
            <input type="email" name="email" id="email" placeholder="Votre email" required>
            <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
            <button type="submit">Se connecter</button>
        </div>
            </form>
        <?php endif; ?>
    </header>

    <main>
 




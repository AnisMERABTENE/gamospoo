<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamos - Accueil</title>
    <link rel="stylesheet" href="/css/home.css"> 
    <style>
        #welcome-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://media.giphy.com/media/FQrKPsolkooUTalcMx/giphy.gif') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #welcome-screen h1 {
            color: white;
            font-size: 3rem;
            font-family: Arial, sans-serif;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.8);
        }
        /* https://media.giphy.com/media/FQrKPsolkooUTalcMx/giphy.gif  */
        /* https://media.giphy.com/media/O58wTsoBqBqMw/giphy.gif */

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            overflow: hidden;
        }

        .hidden {
            display: none;
        }

        .gamos-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .gamos-header {
            background-color: #ff6600;
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        .gamos-title {
            margin: 0;
            font-size: 2rem;
            font-weight: bold;
        }

        .gamos-form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            text-align: center;
            backdrop-filter: blur(5px); 
        }

        .gamos-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .gamos-field {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px;
        }

        .gamos-label {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .gamos-input {
            font-size: 1rem;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        .gamos-input:focus {
            border-color: #ff6600;
            outline: none;
            box-shadow: 0 0 4px rgba(255, 102, 0, 0.3);
        }

        .gamos-button {
            font-size: 1.2rem;
            color: #fff;
            background-color: #ff6600;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .gamos-button:hover {
            background-color: #e65500;
        }

        @media (max-width: 768px) {
            .gamos-form-container {
                padding: 20px;
            }

            .gamos-field {
                max-width: 100%;
            }

            .gamos-button {
                font-size: 1rem;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div id="welcome-screen">
        <h1>Bienvenue sur GAMOS<br></h1>
    </div>

    <div id="main-content" class="hidden">
        <div class="gamos-container">
            <header class="gamos-header">
                <h1 class="gamos-title">Gamos</h1>
            </header>
            <div class="gamos-form-container">
                <form action="/Home/handleForm" method="POST" class="gamos-form">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

                    <div class="gamos-field">
                        <label for="start_date" class="gamos-label">Date de début :</label>
                        <input type="date" id="start_date" name="start_date" class="gamos-input" required>
                    </div>

                    <div class="gamos-field">
                        <label for="end_date" class="gamos-label">Date de fin :</label>
                        <input type="date" id="end_date" name="end_date" class="gamos-input" required>
                    </div>

                    <button type="submit" class="gamos-button">Voir les véhicules</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Animation: Hide welcome screen and show main content
        setTimeout(() => {
            document.getElementById('welcome-screen').style.display = 'none';
            document.getElementById('main-content').classList.remove('hidden');
        }, 3000); // 4 seconds
    </script>
</body>
</html>
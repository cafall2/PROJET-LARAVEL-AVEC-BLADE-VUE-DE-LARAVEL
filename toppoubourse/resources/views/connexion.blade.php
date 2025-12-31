<html>
<head>
    <title>Page de connexion</title>
    <style>
       body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
        }
        nav {
            background-color: #5cb85c;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .signup-btn {
            background-color: #fff;
            border: none;
            color: #5cb85c;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .signup-btn:hover {
            background-color: #5cb85c;
            color: #fff;
        }
        .container {
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
        }
        .separator {
            position: relative;
            width: 100%;
            height: 50px;
            margin-bottom: 20px;
        }
        .separator:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            height: 2px;
            width: 100%;
            background-color: #5cb85c;
            border-radius: 10px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.5);
            clip-path: polygon(0 0, 30% 50%, 0 100%);
        }
        .signup-message {
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 20px;
            border: 2px solid #5cb85c;
            background-color: #f2f2f2;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 24px;
            color: #5cb85c;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.2);
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4ca54c;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 400px;
            margin: auto;
        }

        label {
            margin-top: 20px;
            font-size: 1.2rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1.2rem;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .error-message {
            color: red;
            margin-top: 5px;
            margin-bottom: 20px;
            font-size: 1rem;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo"><h1>ToppouBourse</h1></div>
        <button class="signup-btn" onclick="showForm()">S'inscrire</button>
    </nav>
    <div class="container" id="login-form">
        <div class="separator"></div>
        <div class="signup-message">Connectez-vous si vous êtes déjà inscrit sur la plateforme</div>
        <form action="process_login.php" method="post">
            @csrf <!-- token de sécurité pour Laravel -->
            <h2>Connexion</h2>
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Se connecter">
        </form>
    </div>
    <div class="container" id="signup-form" style="display:none">
        <div class="separator"></div>
        <div class="signup-message">Inscrivez-vous et retournez vous connecter</div>
        <form action="{{ route('register') }}" method="post">
            @csrf <!-- token de sécurité pour Laravel -->
            <h2>Inscription</h2>
            <label for="prenom">Prénom <span>*</span></label>
            <input type="text" id="prenom" name="prenom" required>
            <label for="nom">Nom <span>*</span></label>
            <input type="text" id="nom" name="nom" required>
            <label for="ine">INE <span>*</span></label>
            <input type="text" id="ine" name="ine" required>
            <label for="date_naissance">Date de naissance <span>*</span></label>
            <input type="date" id="date_naissance" name="date_naissance" required>
            <label for="email">Adresse email <span>*</span></label>
            <input type="email" id="email" name="email" required>
            <label for="photo">Photo</label>
            <input type="file" id="photo" name="photo">
            <label for="password">Mot de passe <span>*</span></label>
            <input type="password" id="password" name="password" required>
            <label for="password-confirm">Confirmer le mot de passe <span>*</span></label>
            <input type="password" id="password-confirm" name="password-confirm" required>
            <input type="submit" value="S'inscrire">
        </form>
    </div>
    <script>
        function showForm() {
            document.getElementById("login-form").style.display = "none";
            document.getElementById("signup-form").style.display = "block";
        }
    </script>
</body>
        </html>

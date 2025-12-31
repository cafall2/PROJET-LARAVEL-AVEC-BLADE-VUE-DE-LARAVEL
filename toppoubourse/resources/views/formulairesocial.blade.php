<html>
<head>
    <title>Formulaire d'inscription | ToppouBourse</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
        }
        .header {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
        }
        .header__logo {
            font-size: 20px;
            color: #5cb85c;
            font-weight: bold;
        }
        .header__link {
            font-size: 14px;
            color: #5cb85c;
            text-decoration: none;
        }
        h1 {
            text-align: center;
            color: #5cb85c;
            margin-top: 80px;
            margin-bottom: 30px;
        }
        form {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
            padding: 30px;
            margin-top: 30px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="tel"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.2);
            font-size: 16px;
            color: #333;
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
        .form-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .form-group label {
            flex-basis: 100%;
        }
        .form-group input,
        .form-group select {
            flex-basis: calc(50% - 10px);
        }
        .form-group textarea {
            flex-basis: 100%;
            height: 150px;
            resize: vertical;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header__logo">ToppouBourse</div>
        <a href="/reclamations" class="header__link">Retour aux réclamations</a>
    </div>
    <form method="POST" action="/inscription" enctype="multipart/form-data">
        @csrf <!-- token de sécurité pour Laravel -->
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
        </div>
        <div class="form-group">
            <label for="ine">INE :</label>
            <input type="text" name="ine" id="ine" required>
        </div>
        <div class="form-group">
            <label for="UFR">UFR :</label>
            <input type="text" name="UFR" id="UFR">
        </div>
        <div class="form-group">
            <label for="licence">Licence :</label>
            <input type="text" name="licence" id="licence">
        </div>
        <div class="form-group">
            <label for="date_naissance">Date de naissance :</label>
            <input type="date" name="date_naissance" id="date_naissance" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="photo">Photo :</label>
            <input type="file" name="photo" id="photo">
        </div>
        <div class="form-group">
            <label for="extrait">Extrait d'acte de naissance :</label>
            <input type="file" name="extrait" id="extrait">
        </div>
        <div class="form-group">
            <label for="tel">Téléphone :</label>
            <input type="tel" name="tel" id="tel">
        </div>
        <div class="form-group">
            <label for="certificat_deces">Certificat de décès :</label>
            <input type="file" name="certificat_deces" id="certificat_deces">
        </div>
        <div class="form-group">
            <label for="certificat_egalite_chance">Certificat d'égalité des chances :</label>
            <input type="file" name="certificat_egalite_chance" id="certificat_egalite_chance">
        </div>
        <div class="form-group">
            <label for="certificat_indigence">Certificat d'indigence :</label>
            <input type="file" name="certificat_indigence" id="certificat_indigence">
        </div>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>

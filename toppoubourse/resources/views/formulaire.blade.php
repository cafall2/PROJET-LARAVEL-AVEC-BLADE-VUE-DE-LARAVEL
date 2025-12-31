<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de contact</title>
    <style>
        /* styles */
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
        h1 {
            text-align: center;
            color: #5cb85c;
            margin-bottom: 30px;
        }
        form {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
            padding: 30px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="email"],
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
    </style>
</head>
<body>
    <div class="header">
        <div class="header__logo">ToppouBourse</div>
        <a href="/page2" class="header__link">Retour aux réclamations</a>
    </div>
    <h1>Formulaire de Reclamation</h1>
    <form method="POST" action="{{ route('reclamations.store') }}">
        @csrf
        <!-- form fields -->

        <div class="form-group">
            <label for="objet">Objet :</label>
            <input type="text" name="objet" id="objet" required>
        </div>
        <div class="form-group">
            <label for="message">Message :</label>
            <textarea name="message" id="message" rows="5" required></textarea>
</div>
<input type="submit" value="Envoyer">
    </form>
</body>
</html>

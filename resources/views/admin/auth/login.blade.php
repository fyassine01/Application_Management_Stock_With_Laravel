<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion de Stock ENSA Berrechid</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 2rem;
            max-width: 600px;
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .logo-container {

           
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 1.5rem;
           
        }

        .header-text {
            color: #333;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        .header-title {
            color: #1877f2;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .login-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
        }
        h1 {
            text-align: center;
            color: #1877f2;
            margin-bottom: 1.5rem;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin-bottom: 1rem;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        button {
            background-color: #1877f2;
            color: white;
            padding: 0.8rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #166fe5;
        }
        .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }
        .forgot-password a {
            color: #1877f2;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <img src="{{ asset('img/logo-ensa-berrechid.png') }}" alt="Logo ENSA Berrechid" class="logo">
        </div>
        <div class="header-title">Bienvenue sur l'application de Gestion de Stock de l'ENSA Berrechid</div>
        <p class="header-text">
            Gérez facilement et efficacement votre stock de meubles avec notre application conçue pour les fournisseurs de l'ENSA Berrechid.
        </p>
    </div>
    <div class="login-container">
        <h1>Connexion</h1>
        <form method="POST" action="{{route('admin.login')}}">
            @csrf
            <input name="email" type="email" placeholder="Adresse e-mail" value="{{old('email')}}" required>
            @error('email')
                <div>{{$message}}</div>
            @enderror
            <input name="password" type="password" placeholder="Mot de passe" required>
            @error('password')
                <div>{{$message}}</div>
            @enderror
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
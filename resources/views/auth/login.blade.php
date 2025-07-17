
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Client</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
</head>
<body>
    <div class="login-container">
        <div class="login-img"> 
            <img src="{{ asset('img/ensab1.png') }}" alt="Login Image"> {/* Replace with your image */}
        </div>
        <div class="login-form"> 
            <h2>Connexion Client</h2>
            @if($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <label for="email"><i class='bx bxs-envelope'></i> Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password"><i class='bx bxs-lock-alt' ></i> Mot de passe:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Se Connecter <i class='bx bx-log-in' ></i></button>
                <!--
                <div class="forgot-password">
                     <a href="#">Mot de passe oublié?</a>
                </div>
            -->
            </form>
        </div>
    </div>
</body>
</html>
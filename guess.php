<?php
include 'function.php';
init_game();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['guess'])) {
        $guess = (int) $_POST['guess'];
        $message = check_guess($guess);
    } elseif (isset($_POST['reset'])) {
        reset_game();
        $message = "🔁 Le jeu a été réinitialisé. Devine à nouveau !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>🎯 Jeu de Deviner le Nombre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .btn-guess {
            background-color: #4CAF50;
            color: white;
        }
        .btn-guess:hover {
            background-color: #45a049;
        }
        .btn-reset {
            background-color: #e74c3c;
            color: white;
        }
        .btn-reset:hover {
            background-color: #c0392b;
        }
        .message {
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4 text-center" style="max-width: 420px; margin: auto;">
        <h2 class="mb-3">🎯 Devine le nombre</h2>
        <p class="text-muted">Entre 1 et 100 (max 5 essais)</p>
        <form method="post" class="my-3">
            <div class="input-group mb-3">
                <input type="number" name="guess" class="form-control" min="1" max="100" placeholder="Entre ton nombre..." required 
                       <?= ($_SESSION['game_over'] ?? false) ? 'disabled' : '' ?>>
            </div>
            <div class="d-flex justify-content-center gap-2">
                <button class="btn btn-guess px-4" type="submit" <?= ($_SESSION['game_over'] ?? false) ? 'disabled' : '' ?>>Deviner</button>
                <button class="btn btn-reset px-4" type="submit" name="reset">Réinitialiser</button>
            </div>
        </form>

        <?php if ($message): ?>
            <div class="alert alert-info message mt-3">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <div class="mt-3 text-secondary">
            <small>Essai numéro : <strong><?= $_SESSION['attempts'] ?? 0 ?>/5</strong></small>
        </div>
    </div>
</div>

</body>
</html>
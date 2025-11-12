<?php
session_start();

function init_game() {
    if (!isset($_SESSION['number'])) {
        $_SESSION['number'] = rand(1, 100);
        $_SESSION['attempts'] = 0;
        $_SESSION['game_over'] = false;
    }
}

function check_guess($guess) {
    if ($_SESSION['game_over']) return "🚫 Jeu terminé ! Clique sur Réinitialiser.";

    $_SESSION['attempts']++;
    $n = $_SESSION['number'];

    if ($guess == $n) {
        $a = $_SESSION['attempts'];
        session_unset();
        return "🎉 Gagné en $a tentatives !";
    }

    if ($_SESSION['attempts'] >= 5) {
        $_SESSION['game_over'] = true;
        return "❌ Perdu ! Le nombre était $n.";
    }

    return $guess < $n ? "🔼 Trop petit !" : "🔽 Trop grand !";
}
?>

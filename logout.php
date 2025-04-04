<?php
session_start();        // Démarre une nouvelle session ou reprend une session existante
session_unset();        // Détruit toutes les variables d'une session
session_destroy();      // Détruit une session

header("Location: login.php");

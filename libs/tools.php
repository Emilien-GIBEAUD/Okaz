<?php

/**
 * Convertit une date au format YYYY-MM-DD vers le format DD mois YYYY en français
 * @param string $dateEn Date au format YYYY-MM-DD
 * @return string Date au format DD mois YYYY
 */
function dateEnToFr(string $dateEn): string {
    // Création d'un objet DateTime
    $date = new DateTime($dateEn);
    
    $formatter = new IntlDateFormatter(
        'fr_FR',
        IntlDateFormatter::NONE,
        IntlDateFormatter::NONE,
        null,
        null,
        'd MMMM y'
    );
    return $formatter->format($date);
}
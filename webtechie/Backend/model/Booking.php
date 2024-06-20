<?php

/** Booking Model */
class Booking {
    public $id;         // Eindeutige ID der Buchung
    public $userID;     // Benutzer-ID, die die Buchung vorgenommen hat
    public $price;      // Preis der Buchung
    public $title;      // Titel der Buchung
    public $created_at; // Erstellungsdatum der Buchung

    /**
     * Konstruktor für das Booking-Modell
     * 
     * @param int $id - Eindeutige ID der Buchung
     * @param int $userID - Benutzer-ID, die die Buchung vorgenommen hat
     * @param float $price - Preis der Buchung
     * @param string $title - Titel der Buchung
     * @param string $created_at - Erstellungsdatum der Buchung
     */
    public function __construct(int $id, int $userID, float $price, string $title, string $created_at) {
        $this->id = $id;
        $this->userID = $userID;
        $this->price = $price;
        $this->title = $title;
        $this->created_at = $created_at;
    }
}
?>

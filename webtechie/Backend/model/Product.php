<?php

/** Product Model */
class Product
{
    public $tags;    // Tags zur Kategorisierung des Produkts
    public $datum;   // Datum, wann das Produkt erstellt oder hinzugefügt wurde
    public $id;      // Eindeutige ID des Produkts
    public $title;   // Titel oder Name des Produkts
    public $price;   // Preis des Produkts
    public $image;   // Bild-URL oder Pfad zum Produktbild

    /**
     * Konstruktor für das Produkt-Modell mit Standardwerten
     * 
     * @param string $tags - Tags zur Kategorisierung des Produkts
     * @param string $datum - Datum, wann das Produkt erstellt oder hinzugefügt wurde
     * @param int $id - Eindeutige ID des Produkts
     * @param string $title - Titel oder Name des Produkts
     * @param float $price - Preis des Produkts
     * @param string $image - Bild-URL oder Pfad zum Produktbild
     */
    public function __construct($tags = '', $datum = '', $id = 0, $title = '', $price = 0, $image = "")
    {
        $this->tags = $tags;
        $this->datum = $datum;
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
    }
}
?>

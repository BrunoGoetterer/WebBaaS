<?php

include_once __DIR__ . "/../model/Product.php"; // Einbinden des Product-Modells

/** Product Service Class */
class ProductService
{
    /**
     * Findet alle Produkte und gibt sie als Array zurück
     * 
     * @return array
     */
    public function findAll(): array
    {
        $products = [];

        // Datenbankverbindung herstellen
        $connection = $this->getDatabaseConnection();

        // SQL-Abfrage, um alle Einträge aus der Tabelle 'products' zu erhalten
        $query = "SELECT * FROM products ORDER BY datum DESC";
        $result = $connection->query($query);

        // Jedes Produkt zum Produkt-Array hinzufügen
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product();
                $product->id = $row['id'];
                $product->title = $row['title'];
                $product->price = $row['price'];
                $product->image = $row['image'];
                $product->datum = $row['datum'];
                $product->tags = $row['tags'];
                $products[] = $product;
            }
        }

        return $products;
    }

    /**
     * Findet ein Produkt anhand der ID und gibt es zurück
     * 
     * @param int $id
     * @return Product|null
     */
    public function findByID(int $id): ?Product
    {
        $products = $this->findAll();
        // Durchsucht alle Produkte nach der gegebenen ID
        foreach ($products as $p) {
            if ($p->id == $id) {
                return $p;
            }
        }
        return null;
    }

    /**
     * Speichert ein Produkt in der Datenbank
     * 
     * @param Product $product
     * @return bool
     */
    public function save(Product $product): bool
    {
        // Datenbankverbindung herstellen
        $connection = $this->getDatabaseConnection();

        // SQL-Abfrage zum Einfügen des Produkts in die Datenbank
        $query = "INSERT INTO products (title, price, image, datum) VALUES ('" . $product->title . "', " . $product->price . ", '" . $product->image . "', '" . $product->datum . "')";
        $connection->query($query);

        // Datenbankverbindung schließen
        $connection->close();

        return true;
    }

    /**
     * THIS METHOD IS NOT USED IN THE CURRENT IMPLEMENTATION
     * Löscht ein Produkt aus der Datenbank
     * 
     * @param Product $product
     * @return bool
     */
    public function delete(Product $product): bool
    {
        // Datenbankverbindung herstellen
        $connection = $this->getDatabaseConnection();

        // SQL-Abfrage zum Löschen des Produkts aus der Datenbank
        $query = "DELETE FROM products WHERE id = " . $product->id;
        $connection->query($query);

        // Datenbankverbindung schließen
        $connection->close();

        return true;
    }

    /**
     * Stellt eine Verbindung zur Datenbank her
     * 
     * @return mysqli
     */
    private function getDatabaseConnection()
    {
        // Einbinden der Datenbankzugangsdaten
        require_once __DIR__ . "/../config/dbaccess.php";

        // Erstellen einer neuen MySQLi-Verbindung und zurückgeben
        return new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    }
}
?>

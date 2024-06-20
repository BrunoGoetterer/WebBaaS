<?php

include_once __DIR__ . "/../model/Voucher.php"; // Einbinden des Voucher-Modells

/** Voucher Service Class */
class VoucherService
{
    /**
     * Findet alle Gutscheine und gibt sie als Array zurück
     * 
     * @return array
     */
    public function findAll(): array
    {
        $vouchers = [];

        // Datenbankverbindung herstellen
        $connection = $this->getDatabaseConnection();

        // Aktualisiert den Status abgelaufener Gutscheine
        $this->updateExpiration($connection);

        // SQL-Abfrage, um alle Einträge aus der Tabelle 'vouchers' zu erhalten
        $query = "SELECT * FROM vouchers ORDER BY expiry_date DESC";
        $result = $connection->query($query);

        // Jedes Gutschein zum Gutscheine-Array hinzufügen
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $voucher = new Voucher();
                $voucher->id = $row['id'];
                $voucher->code = $row['code'];
                $voucher->discount = $row['value'];
                $voucher->expiry_date = $row['expiry_date'];
                $voucher->status = $row['status'];
                $voucher->created_at = $row['created_at'];
                $vouchers[] = $voucher;
            }
        }

        // Datenbankverbindung schließen
        $connection->close();

        return $vouchers;
    }

    /**
     * Aktualisiert den Status abgelaufener Gutscheine
     * 
     * @param mysqli $connection
     */
    public function updateExpiration($connection)
    {
        $currentDate = date('Y-m-d');
        $stmt = $connection->prepare("UPDATE vouchers SET status = 'expired' WHERE expiry_date < ? AND status = 'valid'");
        $stmt->bind_param("s", $currentDate);
        $stmt->execute();

        // Schließt das Statement
        $stmt->close();
    }

    /**
     * Speichert einen Gutschein in der Datenbank
     * 
     * @param Voucher $voucher
     * @return bool
     */
    public function save(Voucher $voucher): bool
    {
        // Datenbankverbindung herstellen
        $connection = $this->getDatabaseConnection();

        // SQL-Abfrage zum Einfügen des Gutscheins in die Datenbank
        $stmt = $connection->prepare("INSERT INTO vouchers (code, value, expiry_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $voucher->code, $voucher->discount, $voucher->expiry_date);
        $stmt->execute();

        // Schließt das Statement
        $stmt->close();

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

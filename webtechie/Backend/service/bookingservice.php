<?php


 // THIS FILE IS NOT YET IMPLEMENTED IN THE CURRENT IMPLEMENTATION
class BookingService {
    private static $filename = "../data/bookings.json"; // Pfad zur JSON-Datei mit den Buchungen

    /**
     * Findet alle Buchungen und gibt sie als Array zurück
     * 
     * @return array
     */
    public function findAll() {
        // Versucht den Inhalt der JSON-Datei zu lesen, gibt ein leeres Array zurück, wenn es fehlschlägt
        if (($content = @file_get_contents(self::$filename)) === false) {
            return [];
        }

        // Versucht den JSON-Inhalt zu dekodieren, gibt ein leeres Array zurück, wenn es fehlschlägt
        if (($json = @json_decode($content)) === null) {
            return [];
        }

        return $json;
    }

    /**
     * THIS METHOD IS NOT USED IN THE CURRENT IMPLEMENTATION
     * 
     * Findet eine Buchung anhand der ID NOTE: 
     * 
     * @param int $id
     * @return object|null
     */
    public function findByID($id) {
        $bookings = $this->findAll();
        // Durchsucht alle Buchungen nach der gegebenen ID
        foreach ($bookings as $booking) {
            if ($booking->id == $id) {
                return $booking;
            }
        }
        return null;
    }

    /**
     * Speichert eine Buchung
     * 
     * @param object $booking
     * @return bool
     */
    public function save($booking) {
        $bookings = $this->findAll();
        $maxid = 0;

        // Überprüft, ob die Buchung bereits eine ID hat (Update-Fall)
        if ($booking->id > 0) {
            foreach ($bookings as $key => $value) {
                if ($value->id == $booking->id) {
                    $bookings[$key] = $booking;
                    return $this->persist($bookings);
                }
            }
            return false;
        }

        // Findet die höchste ID und setzt die neue Buchungs-ID auf maxid + 1 (Create-Fall)
        foreach ($bookings as $value) {
            $maxid = max($maxid, $value->id);
        }

        $booking->id = $maxid + 1;
        $bookings[] = $booking;
        return $this->persist($bookings);
    }

    /**
     * THIS METHOD IS NOT USED IN THE CURRENT IMPLEMENTATION
     * Löscht eine Buchung
     * 
     * @param object $booking
     * @return bool
     */
    public function delete($booking) {
        $bookings = $this->findAll();
        // Durchsucht alle Buchungen und löscht die Buchung mit der gegebenen ID
        for ($i = 0; $i < count($bookings); $i++) {
            if ($bookings[$i]->id == $booking->id) {
                array_splice($bookings, $i, 1);
                return $this->persist($bookings);
            }
        }
        return false;
    }

    /**
     * Speichert das Buchungs-Array in der JSON-Datei
     * 
     * @param array $bookings
     * @return bool|int
     */
    private function persist($bookings) {
        // Speichert das Buchungs-Array in der JSON-Datei und gibt die Anzahl der geschriebenen Bytes oder false zurück
        return @file_put_contents(self::$filename, json_encode($bookings, JSON_PRETTY_PRINT));
    }
}
?>

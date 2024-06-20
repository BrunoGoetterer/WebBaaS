<?php

/** Voucher Model */
class Voucher
{
    public $id;            // Eindeutige ID des Gutscheins
    public $code;          // Code des Gutscheins
    public $discount;      // Rabattbetrag oder -prozentsatz des Gutscheins
    public $expiry_date;   // Ablaufdatum des Gutscheins
    public $status;        // Status des Gutscheins (z.B. gültig, abgelaufen)
    public $created_at;    // Erstellungsdatum des Gutscheins

    /**
     * Konstruktor für das Gutschein-Modell
     * 
     * @param int|null $id - Eindeutige ID des Gutscheins
     * @param string|null $code - Code des Gutscheins
     * @param float|null $discount - Rabattbetrag oder -prozentsatz des Gutscheins
     * @param string|null $expiry_date - Ablaufdatum des Gutscheins
     * @param string|null $status - Status des Gutscheins
     * @param string|null $created_at - Erstellungsdatum des Gutscheins
     */
    public function __construct($id = null, $code = null, $discount = null, $expiry_date = null, $status = null, $created_at = null)
    {
        $this->id = $id;
        $this->code = $code ?? $this->generateVoucherCode(); // Erzeugt einen Gutscheincode, falls keiner angegeben ist
        $this->discount = $discount;
        $this->expiry_date = $expiry_date;
        $this->status = $status;
        $this->created_at = $created_at;
    }

    /**
     * Generiert einen zufälligen Gutscheincode
     * 
     * @param int $length - Länge des Gutscheincodes
     * @return string - Der generierte Gutscheincode
     */
    private function generateVoucherCode($length = 5)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
?>

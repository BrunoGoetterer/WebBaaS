<?php

/** User Model */
class User {
    public $id;            // Eindeutige ID des Benutzers
    public $username;      // Benutzername
    public $password;      // Passwort des Benutzers
    public $useremail;     // E-Mail-Adresse des Benutzers
    public $address;       // Adresse des Benutzers
    public $city;          // Stadt des Benutzers
    public $state;         // Bundesland des Benutzers
    public $zip;           // Postleitzahl des Benutzers
    public $anrede;        // Anrede des Benutzers (Herr/Frau/etc.)
    public $firstname;     // Vorname des Benutzers
    public $lastname;      // Nachname des Benutzers
    public $role;          // Rolle des Benutzers (z.B. Admin, Nutzer)
    public $accountstatus; // Status des Benutzerkontos (aktiv/inaktiv)

    /**
     * Konstruktor für das User-Modell
     * 
     * @param int $id - Eindeutige ID des Benutzers
     * @param string $username - Benutzername
     * @param string $password - Passwort des Benutzers
     * @param string $useremail - E-Mail-Adresse des Benutzers
     * @param string $address - Adresse des Benutzers (optional)
     * @param string $city - Stadt des Benutzers (optional)
     * @param string $state - Bundesland des Benutzers (optional)
     * @param int $zip - Postleitzahl des Benutzers (optional)
     * @param string $anrede - Anrede des Benutzers (optional)
     * @param string $firstname - Vorname des Benutzers
     * @param string $lastname - Nachname des Benutzers
     * @param int $role - Rolle des Benutzers (Standardwert 0)
     * @param int $accountstatus - Status des Benutzerkontos (Standardwert 1)
     */
    public function __construct(
        int $id,
        string $username,
        string $password,
        string $useremail,
        string $address = null,
        string $city = null,
        string $state = null,
        int $zip = null,
        string $anrede = null,
        string $firstname,
        string $lastname,
        int $role = 0,
        int $accountstatus = 1
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->useremail = $useremail;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->anrede = $anrede;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->role = $role;
        $this->accountstatus = $accountstatus;
    }
}
?>

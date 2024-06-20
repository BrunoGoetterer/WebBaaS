<?php
 // THIS FILE IS NOT YET IMPLEMENTED IN THE CURRENT IMPLEMENTATION
include_once __DIR__ . "/../model/User.php"; // Einbinden des User-Modells

/** User Service Class */
class UserService
{

    private static $filename = __DIR__ . "/../data/users.json"; // Pfad zur JSON-Datei mit den Benutzerdaten

    /**
     * Findet alle Benutzer und gibt sie als Array zurück
     * 
     * @return array
     */
    public function findAll(): array
    {
        // Versucht, den Inhalt der JSON-Datei zu lesen, gibt ein leeres Array zurück, wenn es fehlschlägt
        if (($content = @file_get_contents(UserService::$filename)) === false) {
            error_log("Error reading file: " . UserService::$filename);
            return [];
        }

        // Versucht, den JSON-Inhalt zu dekodieren, gibt ein leeres Array zurück, wenn es fehlschlägt
        if (($json = @json_decode($content)) === null) {
            error_log("Error decoding JSON");
            return [];
        }

        $users = [];
        // Wandelt jedes JSON-Objekt in ein User-Objekt um und fügt es zum Array hinzu
        foreach ($json as $v) {
            $users[] = new User(
                $v->id,
                $v->username,
                $v->password,
                $v->useremail,
                $v->address ?? "",
                $v->city ?? "",
                $v->state ?? "",
                $v->zip ?? 0,
                $v->anrede ?? "",
                $v->firstname,
                $v->lastname,
                $v->role ?? 0,
                $v->accountstatus ?? 1
            );
        }
        return $users;
    }

    /**
     * Findet einen Benutzer anhand der ID und gibt ihn zurück
     * 
     * @param int $id
     * @return User|null
     */
    public function findByID(int $id): ?User
    {
        $users = $this->findAll();
        // Durchsucht alle Benutzer nach der gegebenen ID
        foreach ($users as $u) {
            if ($u->id == $id) {
                return $u;
            }
        }
        return null;
    }

    /**
     * Speichert einen Benutzer in der JSON-Datei
     * 
     * @param User $user
     * @return bool|User
     */
    public function save(User $user)
    {
        $users = $this->findAll();
        $maxid = 0;

        // Überprüft, ob der Benutzer bereits eine ID hat (Update-Fall)
        if ($user->id > 0) {
            foreach ($users as $k => $v) {
                if ($v->id == $user->id) {
                    $users[$k] = $user;
                    if ($this->persist($users) == false) {
                        return false;
                    }
                    return $user;
                }
            }
            return false;
        }

        // Findet die höchste ID und setzt die neue Benutzer-ID auf maxid + 1 (Create-Fall)
        foreach ($users as $v) {
            $maxid = max($maxid, $v->id);
        }

        $user->id = $maxid + 1;
        $users[] = $user;
        if ($this->persist($users) == false) {
            return false;
        }
        return $user;
    }

    /**
     * Löscht einen Benutzer aus der JSON-Datei
     * 
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        $users = $this->findAll();
        // Durchsucht alle Benutzer und löscht den Benutzer mit der gegebenen ID
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]->id == $user->id) {
                array_splice($users, $i, 1);
                return $this->persist($users);
            }
        }
        return false;
    }

    /**
     * Speichert das Benutzer-Array in der JSON-Datei
     * 
     * @param array $users
     * @return bool
     */
    private function persist(array $users): bool
    {
        // Speichert das Benutzer-Array in der JSON-Datei und gibt true bei Erfolg oder false bei Fehler zurück
        return @file_put_contents(UserService::$filename, json_encode($users)) !== false;
    }
}
?>

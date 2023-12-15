<?php

require_once 'dbconnect.php';

class Jongere
{
    public $id;
    public $firstName;
    public $lastName;
    public $birthDate;
    private PDO $mypdo;
    static $tableName = "jongeren";

    public function __construct(PDO $pdo)
    {
        $this->mypdo = $pdo;
    }

    //Functie om gegevens toe te voegen / wijzigen
    public function Save(): void
    {
        if($this->id > 0) {
            $statement = $this->mypdo->prepare("UPDATE " . self::$tableName . " :id, :firstName, :lastName, :birthDate ");
            $statement->execute([':id' => $this->id, ':firstName' => $this->firstName, ':lastName' => $this->lastName, ':birthDate' => $this->birthDate]);
        } else {
            $statement = $this->mypdo->prepare("INSERT INTO " . self::$tableName . " (id, firstName, lastName, birthDate) VALUES (:id, :firstName, :lastName, :birthDate)");
            $statement->execute([':id' => $this->id, ':firstName' => $this->firstName, ':lastName' => $this->lastName, ':birthDate' => $this->birthDate]);
        }
    }
        

    public function Delete(): void
    {
        $statement = $this->mypdo->prepare("DELETE FROM " . self::$tableName . " WHERE id = :id");
        $statement->execute([':id' => $this->id]);
    }

    public static function Find(int $id, PDO $pdo): Jongere
    {
        $statement = $pdo->prepare("SELECT * FROM " . self::$tableName . " WHERE id = :id");
        $statement->execute([':id' => $id]);
        // Fetch and return the result here
        // ...
        return new Jongere($pdo); // Placeholder return, actual implementation needed
    }

    public static function processForm(PDO $pdo, array $formData): void
    {
        $jongere = new jongere($pdo);
        
        $jongere->firstName = $formData['firstName'];
        $jongere->lastName = $formData['lastName'];
        $jongere->birthDate = $formData ['birthDate'];

        $jongere->Save();
    }

    public static function GetJongere(PDO $pdo): array
    {
        $statement = $pdo->prepare("SELECT * FROM " . self::$tableName);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function DisplayJongere(PDO $pdo) : string
    {
        $result = self::GetJongere($pdo);

        $html = '';

        foreach ($result as $row)
        {
            $formattedBirthDate = date('d-m-Y', strtotime($row["birthDate"]));

            $html .= '<tr>';
            
            $html .= '<td>' . $row["id"] . '</td>';
            $html .= '<td>' . $row["lastName"] . '</td>';
            $html .= '<td>' . $row["firstName"] . '</td>';
            $html .= '<td>' . $formattedBirthDate . '</td>';

            $html .= '<td>';
            $html .= '<a href="#">Wijzigen</a> | ';
            $html .= '<a href="#" onclick="return confirm(\'Weet je zeker dat je dit instituut wilt verwijderen?\')">Verwijderen</a>';
            $html .= '</td>';

            $html .= '</tr>';

        }

        return $html;
    }
}

?>

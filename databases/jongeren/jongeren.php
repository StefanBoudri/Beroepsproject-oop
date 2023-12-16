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
            $statement = $this->mypdo->prepare("UPDATE " . self::$tableName . " SET firstName = :firstName, lastName = :lastName, birthDate = :birthDate WHERE id = :id");
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

    public static function GetJongeren(PDO $pdo): array
    {
        $statement = $pdo->prepare("SELECT * FROM " . self::$tableName . " ORDER BY lastName");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function DisplayJongeren(PDO $pdo) : string
    {
        $result = self::GetJongeren($pdo);

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
            $html .= '<a href="databases/jongeren/edit.php?id=' . $row["id"] . '">Wijzigen</a> | ';
            $html .= '<a href="databases/jongeren/process.php?id=' . $row["id"] . '">Verwijderen</a>';
            $html .= '</td>';
            $html .= '</tr>';
        }
            
        return $html;
    }
}

?>

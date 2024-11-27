
<?php
class VoitureRepository {
    public $dbh;

    public function __construct($dbh) 
    {
        $this->dbh=$dbh;
    }


    public function showRandomVoitures() {
        $query = "SELECT * FROM Voitures ORDER BY RAND() LIMIT 3";
        $stmt = $this->dbh->query($query);

        if ($stmt->execute()) {
            $voitures = $stmt->fetchAll(PDO::FETCH_ASSOC); 

            return $voitures; 
        } else {
            return [];
        }
 
    }   
}
?>


      
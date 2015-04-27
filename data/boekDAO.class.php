<?php


require_once("data/dbc.class.php");
require_once("entities/boek.class.php");
require_once("entities/genre.class.php");

class BoekDAO
{
    private $handler;
    private $sql;
    private $query;
    private $result;
    private $genre;
    private $lijst;

    private function connectToDB()
    {
        /**
         * Connect to DB
         */
        $this->handler = new Dbc();
        $this->handler = $this->handler->startConnection();
    }


    public function getAll()
    {
        self::connectToDB();
        $this->sql = "SELECT boek.id, boek.titel, boek.genre_id, genre.omschrijving FROM mvc_boeken boek INNER JOIN mvc_genres genre ON boek.genre_id=genre.genre_id";

        try{
            $this->query = $this->handler->query($this->sql);
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->query->closeCursor();
            $this->handler = null;

            foreach ($this->result as $row)
            {
                $this->genre = Genre::create($row['genre_id'],$row['omschrijving']);
                $this->lijst[] = Boek::create($row['id'], $row['titel'], $this->genre);
            }
            return $this->lijst;
        }
        catch(Exception $e){
            echo "Error: Ошибка с запросом";
            return false;
        }

    }
}
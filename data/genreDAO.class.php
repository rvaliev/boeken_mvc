<?php


require_once("data/dbc.class.php");
require_once("entities/genre.class.php");


class GenreDAO
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
        $this->sql = "SELECT genre_id, omschrijving FROM mvc_genres";

        try{
            $this->query = $this->handler->query($this->sql);
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->query->closeCursor();
            $this->handler = null;

            foreach ($this->result as $row)
            {
                $this->lijst[] = Genre::create($row['genre_id'],$row['omschrijving']);
            }
            return $this->lijst;
        }
        catch(Exception $e){
            echo "Error: Ошибка с запросом";
            return false;
        }

    }
}

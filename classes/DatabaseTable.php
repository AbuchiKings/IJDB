<?php

class DatabaseTable
{
    public $pdo;
    public $table;
    public $primaryKey;

    public function __construct($pdo, $table, $primaryKey)
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    private function query( $sql, $parameters = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    private function processDates($fields)
    {
        foreach ($fields as $key => $value) {
            if ($value instanceof DateTime) {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }

    public function delete($id)
    {
        $parameters = [':id' => $id];
        $this->query('DELETE FROM `' . $this->table . '`
    WHERE `' . $this->primaryKey . '` = :id', $parameters);
    }

    private function insert( $fields)
    {
        $query = 'INSERT INTO `' . $this->table . '` (';
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '`,';
        }
        $query = rtrim($query, ',');
        $query .= ') VALUES (';
        foreach ($fields as $key => $value) {
            $query .= ':' . $key . ',';
        }
        $query = rtrim($query, ',');
        $query .= ')';
        $fields = $this->processDates($fields);
        $this->query( $query, $fields);
    }

    private function update($fields)
    {
        $query = ' UPDATE `' . $this->table . '` SET ';
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '` = :' . $key . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';
        // Set the :primaryKey variable
        $fields['primaryKey'] = $fields['id'];
        $fields = $this->processDates($fields);
        $this->query($query, $fields);
    }

    public function save($record)
    {
        try {
            if ($record[$this->primaryKey] == '') {
                $record[$this->primaryKey] = null;
            }
            $this->insert($this->pdo, $this->table, $record);
        } catch (PDOException $e) {
            $this->update($this->pdo, $this->table, $this->primaryKey, $record);
        }
    }


    public function total()
    {
        $query = $this->query('SELECT COUNT(*)
    FROM `' . $this->table . '`');
        $row = $query->fetch();
        return $row[0];
    }

    public function findAll()
    {
        $result = $this->query('SELECT * FROM `' . $this->table . '`');
        return $result->fetchAll();
    }

    public function findById( $value)
    {
        $query = 'SELECT * FROM `' . $this->table . '`
        WHERE `' . $this->primaryKey . '` = :value';
        $parameters = [
            'value' => $value
        ];
        $query = $this->query($query, $parameters);
        return $query->fetch();
    }

    public function allJokes()
    {
        $sql = 'SELECT `joke`.`id`, `joketext`, `jokedate`,`name`, `email`
        FROM `joke` INNER JOIN `author` ON `authorid` = `author`.`id`';
        $jokes =  $this->query($sql);
        return $jokes->fetchAll();
    }
}

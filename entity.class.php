<?php

/**
 * Generate an entity object that provide CRUD operation for a database table.
 *
 * @author   Fabian Dennler <fd@fabforge.ch>
 */
class Entity
{
  private $connection = '';
  private $table = '';
  public $columns;
  public $data = array();

  /* @param string $table The name of the table to generate code for. */
  public function __construct($link, $table)
  {
    $this->connection = $link;
    $this->table = $table;
    $this->describe();
  }
  
  /**
   * Get the data definition for the requested table.
   */
  private function describe()
  {
    try {
      $sql = "DESCRIBE " . $this->table;
      $statement = $this->connection->prepare($sql);
      if ($statement->execute()) {
        $result = $statement->get_result();
        while ($row = $result->fetch_object()) {
          $this->columns[$row->Field] = array(
            'name' => $row->Field,
            'type' => $row->Type,
            'key' => $row->Key,
            'extra' => $row->Extra,
          );
        }
        ksort($this->columns);
      }
    } catch (Exception $e) {
      throw $e;
    }
  }  
}
$users = new Entity($connection, "users");
<?php

namespace App\Core\Model;

abstract class Model
{

   protected string $table;
   protected $database;

   public function __construct($database)
   {
      $this->database = $database;
   }


   public function all()
   {
      // var_dump($this->table);
      return $this->database->query("select * from $this->table", $this->getEntity());
   }

   // public function find($id)
   // {
   //    return $this->database->query("select * from $this->table where id = ?", $this->getEntity(), true);

   // }
   public function find($id)
   {
      $sql = "SELECT * FROM $this->table WHERE id = :id";
      return $this->database->prepare($sql, ['id' => $id], $this->getEntity(), true);
   }


   public function query(string $sql, string $entityName, bool $single = false)
   {
      return $this->database->query($sql, $entityName, $single);
   }

   // public function delete()
   // {
   // }

   public function delete($id)
   {
      $sql = "DELETE FROM $this->table WHERE id = :id";
      return $this->database->prepare($sql, ['id' => $id]);
   }

   public function save(array $data)
   {

      $this->database->query("insert into $this->table () values ()", $this->getEntity());
      $this->database->query("", $this->getEntity());
   }

   public static function update()
   {
   }

   public function setDatabase($database)
   {
      $this->database = $database;
   }

   public abstract function getEntity();

   public function hasMany($relatedModel, $foreignKey, $localKey)
   {
      $relatedModelInstance = new $relatedModel($this->database);
      $sql = "SELECT * FROM " . $relatedModelInstance->table . " WHERE $foreignKey = :id";
      return $this->database->prepare($sql, ['id' => $localKey], $relatedModelInstance->getEntity());
   }

   public function belongsTo($relatedModel, $foreignKey, $ownerKey)
   {
      $relatedModelInstance = new $relatedModel($this->database);
      $sql = "SELECT * FROM " . $relatedModelInstance->table . " WHERE id = :id";
      return $this->database->prepare($sql, ['id' => $foreignKey], $relatedModelInstance->getEntity(), true);
   }

   public function belongsToMany($relatedModel, $pivotTable, $foreignKey, $relatedKey, $localKey)
   {
      $relatedModelInstance = new $relatedModel($this->database);
      $sql = "SELECT * FROM " . $relatedModelInstance->table . " 
            INNER JOIN $pivotTable ON " . $relatedModelInstance->table . ".id = $pivotTable.$relatedKey
            WHERE $pivotTable.$foreignKey = :id";
      return $this->database->prepare($sql, ['id' => $localKey], $relatedModelInstance->getEntity());
   }


   public function transaction(callable $callback)
   {
       try {
           $this->database->beginTransaction();
           $callback($this);
           $this->database->commit();
       } catch (\Exception $e) {
           $this->database->rollBack();
           throw $e;
       }
   }
}

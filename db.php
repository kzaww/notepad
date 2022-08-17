<?php
class connection 
{
    public $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=note",'root','');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Fail!!".$e->getmessage();
        }
    }

    public function getNote()
    {
        $sts = $this->pdo->prepare("SELECT * FROM notes ORDER BY created_at DESC");
        $sts->execute();
        return $sts->fetchAll(PDO::FETCH_ASSOC);   //row akone u mr so top fetchAll
    }

    public function newNote($note)
    {
        $sts = $this->pdo->prepare("INSERT INTO notes (title, description, created_at)
                                        VALUES (:title, :description, :created_at)");
        $sts->bindParam(':title',htmlspecialchars($note['title']));
        $sts->bindParam(':description',$note['description']);
        $sts->bindValue('created_at',date('Y/m/d H:i:s'));
        return $sts->execute();
    }

    public function editNote($id)
    {
        $sts = $this->pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sts->bindParam(':id',$id);
        $sts->execute();
        return $sts->fetch(PDO::FETCH_ASSOC);     // row ta ku pl u mr so top fetch 
    }

    public function updateNote($id,$note)
    {
        $sts = $this->pdo->prepare("UPDATE notes SET title= :title ,description = :description WHERE id=:id");
        $sts->bindParam(':id',$id);
        $sts->bindParam(':title',$note['title']);
        $sts->bindParam(':description',$note['description']);
        return $sts->execute();
    }

    public function seeMore($id)
    {
        $sts = $this->pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sts->bindParam(':id',$id);
        $sts->execute();
        return $sts->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sts = $this->pdo->prepare("DELETE FROM notes WHERE id = :id");
        $sts->bindParam(':id',$id);
        $sts->execute();
    }
}

return
new connection();
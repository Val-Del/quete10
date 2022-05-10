<?php 
class Bdd {
    private function dbConnect(){
        try{
            $db = new PDO(
                'mysql:host=localhost;dbname=championDwwm2;charset=UTF8',
                'root',
                ''
            );
            return $db;
        }
        catch(Exception $e){
            die ("Error: " . $e->getMessage());   
        }
    }
    function checkTableExist(){
        $db = $this->dbConnect();
        $test = $db->prepare( "DESCRIBE `championDwwm2`");
        if ( $test->execute() ) {
            echo '<div class="alert alert-success" role="alert"> 
            La table exist!
          </div>';
          return TRUE;
        } else {
            echo '<div class="alert alert-primary" role="alert">
            La table n\'existe pas!
          </div>'; 
          return FALSE;
        }
    }
    function checkTableEmpty() {
        $db = $this->dbConnect();
        $readTable = $db->prepare('SELECT * FROM championDwwm2');
        $readTable->execute();
        $readAll = $readTable->fetchall();
        if ($this->checkTableExist() == TRUE) {    // check si la table exist, si oui check si elle est vide
            if($readAll){
                echo "not empty";
            }else {
                echo "Mais elle est empty";
            }
        }
        // else {
        //     echo "La table n'existe pas, et est donc vide";
        // }
        
    }
    function createTable(){
        $db = $this->dbConnect();
        $create = $db->prepare('CREATE TABLE championDwwm2 (
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
        first_name varchar (250),
        last_name varchar (250),
        age int,
        size float,
        situation varchar (250)
        )');
        $create->execute();
        echo 'table créé';
    }
    function readTable (){  
        $db = $this->dbConnect();
        $readTable = $db->prepare('SELECT * FROM championDwwm2');
        $readTable->execute();
        $readAll = $readTable->fetchall();
        $this->card($readAll);
    }
    function truncateTable(){
        $db = $this->dbConnect();
        $truncateTable = $db->prepare('TRUNCATE TABLE championDwwm2');
        $truncateTable->execute();
        echo 'table vidée';
    }
    function dropTable() {
        $db = $this->dbConnect();
        $drop = $db->prepare('DROP TABLE championDwwm2');
        $drop->execute();
        echo 'table drop';
    }
    function createAll(){
        $db = $this->dbConnect();
        $createAll = $db->prepare('INSERT INTO championDwwm2 (first_name, last_name, age, size, situation)
        VALUES ("Valentin", "bruneel",28, 174, "étudiant"),
        ("Anne", "Devos",55, 174, "étudiant"),
        ("Omar", "xxx",20, 174, "étudiant"),
        ("Yulliah", "xxx",56, 174, "étudiant"),
        ("JB", "xxx",23, 174, "étudiant"),
        ("JR", "xxx",32, 174, "étudiant"),
        ("Collin", "xxx",25, 174, "étudiant"),
        ("Nicolas", "xxx",21, 174, "étudiant"),
        ("Aymeric", "Paris",27, 174, "Formateur")
        ');
        $createAll->execute();
        echo 'données ajouter';
    }
    function readOne($name){
        $db = $this->dbConnect();
        $readOne = $db->prepare('SELECT * FROM championDwwm2 WHERE first_name = :name');
        $readOne->execute(['name'=>$name]);
        $readAll = $readOne->fetchall();
        $this->card($readAll);
    }
    function addOne($name) {
        $db = $this->dbConnect();
        $readOne = $db->prepare('SELECT * FROM championDwwm2 WHERE first_name = :name');
        $readOne->execute(['name'=>$name]);
        $readAll = $readOne->fetchall();
        $this->card($readAll);
        $rage = $readAll[0]['age'];
        $rage++;
        $updateOne = $db->prepare('UPDATE championDwwm2
        SET age = :rage
        WHERE first_name = :name');
        $updateOne->execute([
            'rage' => $rage,
            'name' => $name
        ]);
    }
    function addOnee() {
        $db = $this->dbConnect();
        $addOnee = $db->prepare('INSERT INTO championDwwm2 (first_name, last_name, age, size, situation)
        VALUES ("Valentin", "bruneel",28, 174, "étudiant")');
        $addOnee->execute();
        
    }
    function deleteRandom() {
        $db = $this->dbConnect();
        $getId = $db->prepare('SELECT id FROM championDwwm2');
        $getId->execute();
        $ids = $getId->fetchAll();
        $random = array_rand($ids);
        $deleteOne = $db->prepare('DELETE FROM championDwwm2
        WHERE id = :id');
        $deleteOne->execute([
            'id' => $random
        ]);
        
    }
    function deleteRandomSql(){
        $db = $this->dbConnect();
        $deleteSql = $db->prepare('SELECT id FROM championDwwm2
        ORDER BY RAND()
        LIMIT 1');
        $deleteSql->execute();
        $id = $deleteSql->fetch();
        $deleteOne = $db->prepare('DELETE FROM championDwwm2
        WHERE id = :id');
        $deleteOne->execute([
            'id' => $id['id']
        ]);
    }
    function deleteRandomSql2() {
        $db = $this->dbConnect();
        $deleteSql = $db->prepare('DELETE FROM championDwwm2 ORDER BY RAND() LIMIT 1');
        $deleteSql->execute();
    }
    function deleteOne($name){
        $db = $this->dbConnect();
        $deleteOne = $db->prepare('DELETE FROM championDwwm2
        WHERE first_name = :name');
        $deleteOne->execute([
            'name' => $name
        ]);
    }
    function listAsc(){
        $db = $this->dbConnect();
        $listAsc = $db->prepare('SELECT * FROM championDwwm2 ORDER BY first_name asc');
        $listAsc->execute();
        $list = $listAsc->fetchall();
        $this->card($list);
    }
    function card($list) {
        foreach($list as $l) {
            include 'cardView.php';
            // echo '<div class="container">';
            // echo $l['first_name'] . '<br>';
            // echo $l['last_name']. '<br>';
            // echo $l['age']. '<br>';
            // echo $l['size']. '<br>';
            // echo $l['situation']. '<br>';
            // echo '</div><br>';
        }
    }
}
?>
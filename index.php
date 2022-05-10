<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Evaluation</title>
</head>
<body >
    <?php 
    include_once 'includes/nav.include.php';
    include_once 'class/Bdd.php';
    $bdd = new Bdd;
    ?>
    <?php 
    if(isset($_GET['createTable'])) {
        $bdd->createTable();
    }
    elseif(isset($_GET['readTable'])) {
        $bdd->readTable();
    }
    elseif(isset($_GET['truncateTable'])) {
        $bdd->truncateTable();
    }
    elseif(isset($_GET['dropTable'])) {
        $bdd->dropTable();
    }
    elseif(isset($_GET['createAll'])) {
        $bdd->createAll();
    }
    elseif(isset($_GET['readOne'])) {
        $bdd->readOne('Valentin');
    }
    elseif(isset($_GET['addOne'])) {
        $bdd->addOne('Valentin');
    }
    elseif(isset($_GET['addOnee'])) {
        $bdd->addOnee('Valentin');
    }
    elseif(isset($_GET['deleteOne'])) {
        $bdd->deleteOne('Valentin');
    }
    elseif(isset($_GET['testTable'])) {
        $bdd->checkTableExist();
    }
    elseif(isset($_GET['testTableEmpty'])) {
        $bdd->checkTableEmpty();
    }
    elseif(isset($_GET['testDeleteRandom'])) {
        $bdd->deleteRandom();
    }
    elseif(isset($_GET['testDeleteRandomSql'])) {
        $bdd->deleteRandomSql();
    }
    elseif(isset($_GET['testDeleteRandomSql2'])) {
        $bdd->deleteRandomSql2();
    }
    elseif(isset($_GET['listAsc'])) {
        $bdd->listAsc();
    }else {
        include_once 'indexView.php';
    }
    ?>
<footer>
    <div class="container">
        <p>Valentin Bruneel 2022 </p>
    </div>
</footer>
</body>
</html>
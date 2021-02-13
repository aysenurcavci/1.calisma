<html>
<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <script>
        function myFunction(demo) {
            document.getElementById(demo).style.textDecoration = "line-through";
        }
    </script>

</head>
<body>

<?php

include('config.php');
include('todolist.php');

$app = new TodoList( date('Y.m.d.') );

$todolist = $app->getTodos();
$reqMethod = $_SERVER['REQUEST_METHOD'];

if($reqMethod = 'POST'){
    $app->add();
}

if (!isset ($_GET ['sayfa'])){
    $_GET['sayfa'] = 'index';
}

switch($_GET['sayfa']) {

    case 'update':
        $app->update($_GET['id']);
        break;


    case 'delete':
        $app->delete($_GET['id']);
        break;

}

$todolist = $app->getTodos();
?>

<div class="container ">
    <form action="index.php" method="post">
        <input type="text" name="new">
        <input class="btn btn-outline-dark btn-rounded"
               data-mdb-ripple-color="dark" type="submit" value="EKLE">
    </form>


    <table cellspacing="5" cellpadding="6" >
        <tr>
            <td align="center" colspan="5" >TO DO</td>
        </tr>
        <tr>
            <td colspan="2"width="300" align="center">Yapılacaklar</td>
            <td colspan="2" align="center">İşlemler</td>
        </tr>
        <tr>
            <?php foreach($todolist as $k=>$v ) :?>
        </tr>

            <td><button type="button" class=" btn-outline-dark btn-rounded" data-mdb-ripple-color="dark"
                        onclick="myFunction(<?php echo $k ?>)">
                        O</button></td>
            <td id="<?php echo $k ?>" class="text-dark text-uppercase"><?php echo $v ?></td>
            <td><button type="button" class="btn btn-outline-dark btn-rounded"
                        data-mdb-ripple-color="dark"><a href="index.php?sayfa=update&id=<?php echo $k ?>">
                        DUZENLE</a></button></td>
            <td><button type="button" class="btn btn-outline-dark btn-rounded"
                        data-mdb-ripple-color="dark"><a href="index.php?sayfa=delete&id=<?php echo $k ?>">
                        SİL</a></button></td>
        <tr>
            <?php endforeach;?>
        </tr>
    </table>
</div>
</body>
</html>

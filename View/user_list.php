<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet"  href="user.css">
</head>
<body>
    <div class="content">
        <?php
        require_once ("../Model/user_table.php");
        UserTable::generateTable();
        ?>
        <form action="../Controller/action.php" method="POST">
            <button type="submit" name="deconnect">SE DECONNECTER</button>
        </form>
    </div>
</body>
</html>

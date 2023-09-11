<!doctype html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Modifier catégorie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <h4>Modifier catégorie</h4>
    <?php
    require_once 'include/database.php';
    $sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id=?');
    $id = $_GET['id'];
    $sqlState->execute([$id]);

    $category = $sqlState->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['modifier'])) {
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $icon = $_POST['icon'];

        if (!empty($libelle) && !empty($description)) {
            $sqlState = $pdo->prepare('UPDATE categorie
                                                SET libelle = ? ,
                                                    description = ?,
                                                    icon = ?
                                            WHERE id = ?
                                            ');
            $sqlState->execute([$libelle, $description, $icon, $id]);
            header('location: categories.php');
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Libelle , description sont obligatoires
            </div>
            <?php
        }

    }

    ?>
    <form method="post">
        <input type="hidden" class="form-control" name="id" value="<?php echo $category['id'] ?>">
        <label class="form-label">Libelle</label>
        <input type="text" class="form-control" name="libelle" value="<?php echo $category['libelle'] ?>">

        <label class="form-label">Description</label>
        <textarea class="form-control" name="description"><?php echo $category['description'] ?></textarea>

        <label class="form-label">Icône</label>
        <input type="text" class="form-control" name="icon" value="<?php echo $category['icon'] ?>">

        <input type="submit" value="Modifier catégorie" class="btn btn-primary my-2" name="modifier">
    </form>
</div>

</body>
</html>
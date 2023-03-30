<?php
require_once('./header.php');
?>

<div class="container">

    <form method="POST" action="../controllers/login.controller.php">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <?php
    if (isset($_SESSION) && isset($_SESSION['mensagem'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['mensagem']; ?>
        </div>
    <?php }
    unset($_SESSION['mensagem']);
    ?>

</div>

<?php
require_once('./footer.php');

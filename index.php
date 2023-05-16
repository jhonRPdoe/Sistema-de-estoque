<?php
    include_once("templates/header.php")
?>
<div class="container">
        <h1 id="main-title">Produtos</h1>
        <?php if(count($products) > 0): ?>
            <table class="table" id="contacts-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $product): ?>
                        <tr>
                            <td scope="row" class="col-id"><?= $product["id"] ?></td>
                            <td scope="row"><?= $product["nome"] ?></td>
                            <td scope="row"><?= $product["valorVenda"] ?></td>
                            <td scope="row"><?= $product["quantidade"] ?></td>
                            <td class="actions">
                                <a href="<?= $BASE_URL ?>/index.php?id=<?= $product["id"] ?>"><i class="fas fa-eye check-icon"></i></a>
                                <a href="<?= $BASE_URL ?>/update.php?id=<?= $product["id"] ?>"><i class="far fa-edit edit-icon"></i></a>
                                <form class="delete-form" action="<?= $BASE_URL ?>/config/process.php" method="POST">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id" value="<?= $product["id"] ?>">
                                    <button type="submit" class="delete-btn"><i class="fas fa-times delete-icon"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p id="empty-list-text">Ainda não há produtos no estoque, <a href="<?= $BASE_URL ?>/create.php">clique aqui para adicionar</a>.</p>
        <?php endif; ?>
    </div>
<?php
    include_once("templates/footer.php")
?>
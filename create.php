
<?php
    include_once("templates/header.php")
?>

  <div class="container">
    <h1>Cadastro de produtos</h1>
    
    <form action="<?= $BASE_URL ?>/config/process.php" method="POST" class='formulario'>
      <input type="hidden" name="type" value="create">
      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" required>
      <label for="valor">Valor</label>
      <input type="text" id="valor" name="valor" required>
      <label for="quantidade">Quantidade</label>
      <input type="number" id="quantidade" name="quantidade" required>
      <button type="submit" class="submit">Enviar</button>
    </form>
  </div>

<?php
    include_once("templates/footer.php")
?>
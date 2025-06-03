<?php 
  require __DIR__ . '/layout/header.php'; 
  require __DIR__ . '/layout/cards.php';
?>

<h2>Serviços</h2>

<div class="cards-container">
  <?php 
    
    cardServicos(0, "Nome do Servico", 2,  44.9);
    cardServicos(0, "Outro Servico", 5,  154.9);
    
    
  ?>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>
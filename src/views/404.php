<?php require_once 'includes/header.php'; ?>

<div class="error-404">
    <h1>404</h1>
    <h2>Página não encontrada</h2>
    <p>A página que você está procurando não existe ou foi movida.</p>
    <a href="<?php echo SITE_URL; ?>" class="botao">Voltar para a página inicial</a>
</div>

<style>
.error-404 {
    text-align: center;
    padding: 4em 2em;
    min-height: calc(100vh - 200px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.error-404 h1 {
    font-size: 6em;
    color: #9b1c1c;
    margin: 0;
}

.error-404 h2 {
    font-size: 2em;
    color: #333;
    margin: 0.5em 0;
}

.error-404 p {
    font-size: 1.2em;
    color: #666;
    margin-bottom: 2em;
}

.error-404 .botao {
    background-color: #9b1c1c;
    color: white;
    text-decoration: none;
    padding: 1em 2em;
    border-radius: 0.5em;
    font-size: 1.2em;
    transition: all 0.3s ease;
}

.error-404 .botao:hover {
    background-color: #742424;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}
</style>

<?php require_once 'includes/footer.php'; ?> 
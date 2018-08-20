<?php include 'includes/header.php'?>

<section class="container">
    <article class="form-contact">
        <h1 class="the-font">Contato</h1>
        
        <?php if (isset($_GET['status'])) { ?>
                <br/>
                <?php if ($_GET['status'] == '1') { ?>
                    <p class="alert alert-success"><?= $_GET['msg'] ?></p>
                <?php } elseif ($_GET['status'] == '0') { ?>
                    <p class="alert alert-danger"><?= $_GET['msg'] ?></p>
                <?php } ?>
            <?php } ?>
        
        <form id="form-contato" action="util/send.php" method="post">
            <input type="text" name="nome" placeholder="Nome">
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="assunto" placeholder="Assunto">
            <textarea name="mensagem" id="" cols="30" rows="10"  placeholder="Mensagem"></textarea>
            <button class="btn-mine">Enviar</button>
        </form>
    </article>
    <aside class="sidebar">
        <h2 class="the-font">Endereço</h2>
        <p>Rua Quintino Bocaiuva 850, sala 04 - Centro </p>
        <p>Telefones: (045) 3027-0059</p>
        <p>E-mail: contato@delioncafe.com.br</p>
    </aside>
</section>

<script>
    window.onload = function () {
        $("#form-contato").validate({
            rules: {
                nome: "required",
                email: "required",
                assunto: "required"
            },
            messages: {
                nome: "<?=Lang::_t_si('Campo Obrigatório')?>",
                email: "<?=Lang::_t_si('Campo Obrigatório')?>",
                assunto: "<?=Lang::_t_si('Campo Obrigatório')?>"
            }
        });
    };

</script>


<?php include 'includes/footer.php'?>

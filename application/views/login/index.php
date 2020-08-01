

<div class="container">
    <img class="imgLogo" src="../../../public/img/ead.png" alt="UniCeub" />
    <div class="content">
        <form name="form_autenticacao_login" method="POST" action="<?php echo base_url('login/validacao_login') ?>">
            <label htmlFor="ra">Informe seu E-mail.</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fas fa-user-graduate prefix"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="email" placeholder="Digite seu RA" aria-label="email" aria-describedby="basic-addon" />
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon">
                        <i class="fa fa-lock prefix"></i>
                    </span>
                </div>
                <input type="password" class="form-control" name="password" placeholder="Digite sua senha" aria-label="Username" aria-describedby="basic-addon" />
            </div>
            <button class="btn" type="submit">Entrar <i class="fas fa-sign-in-alt"></i></button>
        </form>
    </div>
    <?php if($message = $this->session->flashdata('error')):?>
        <div>
            <label>
            </label>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $message?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            </div>
        </div>
    <?php endif;?>
</div>

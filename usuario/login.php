<?php
include_once "../cabecalho.php";
?>
<div class="container">

    <form class="form-signin" action="processamento.php?acao=logar" method="post">
        <div class="panel periodic-login">
            <span class="atomic-number">28</span>
            <div class="panel-body text-center">
                <h1 class="atomic-symbol">Mi</h1>
                <p class="atomic-mass">14.072110</p>
                <p class="element-name">Miminium</p>

                <i class="icons icon-arrow-down"></i>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="email" class="form-text" name="email" required>
                    <span class="bar"></span>
                    <label>E-mail</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" name="senha" required>
                    <span class="bar"></span>
                    <label>Senha</label>
                </div>
                <label class="pull-left">
                    <input type="checkbox" class="icheck pull-left" name="checkbox1"/> Remember me
                </label>
                <input type="submit" class="btn col-md-12" value="Login"/>
            </div>
            <div class="text-center" style="padding:5px;">
                <a href="forgotpass.html">Esqueceu a Senha</a>
                <a href="formulario.php">| Inscrição</a>
            </div>
        </div>
    </form>
</div>

<?php
include_once "../rodape.php";
?>
<?php $this->layout('site/master') ?>

<h2>Login</h2>
<?php echo getFlash('message'); ?>

<form action="/login" method="post">
    
    <input type="text" name="email" value="avraham_peretz@hotmail.com" placeholder="seu email" class="form-control"><br>
    <?php echo getFlash('email'); ?>

    <input type="password" name="password" value="123" placeholder="Sua senha" class="form-control"><br>
    
    <?php echo getFlash('password'); ?><br>

    <button type="submit" class="btn btn-info" id="btn-create">Logar</button>
</form>
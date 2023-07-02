<?php $this->layout('site/master', ['title' => 'home']); ?>

<h2>Create</h2>

<form action="/user/store" method="post">
    <input type="hidden" name="<?php var_dump($csrf);  ?>">
    <input type="text" name="firstName" class="form-control" value="<?= old('firstName') ?>" placeholder="First Name"><br>
    <?php echo getFlash('firstName'); ?>

    <input type="text" name="lastName"  class="form-control" value="<?= old('lastName') ?>" placeholder="Last Name"><br>
    <?php echo getFlash('lastName'); ?>

    <input type="text" name="email"     class="form-control" value="<?= old('email') ?>" placeholder="E-mail"><br>
    <?php echo getFlash('email'); ?>
    
    <input type="password" name="password"     class="form-control" value="" placeholder="Password"><br>
    <?php echo getFlash('password'); ?><br>
       
    <button type="submit">Cadastrar</button>
</form>
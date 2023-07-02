<?php $this->layout('site/master') ?>

<h2>Edit</h2>

{{ messages['message']['message']|message( messages['message']['alert'])|raw }}

<form action="/user/update/{{ user.id }}" method="post">
    <input type="hidden" name="_METHOD" value="PUT">
    <input type="text" name="firstName" class="form-control" value="{{ user.firstName }}"><br>
    <?php echo getFlash('firstName'); ?>

    <input type="text" name="lastName"  class="form-control" value="{{ user.lastName }}"><br>
    <?php echo getFlash('lastName'); ?>

    <input type="text" name="email"     class="form-control" value="{{ user.email }}"><br>
    <?php echo getFlash('email'); ?>
    
    <input type="password" name="password"     class="form-control" value="{{ user.password }}"><br>
    <?php echo getFlash('email'); ?>
    <button type="submit">Atualizar</button>
</form>

{% endblock %}
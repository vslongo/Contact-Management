<h1>Login</h1>
<?php if (isset($errors['email'])): ?>
    <div class="error"><?php echo $errors['email'][0]; ?></div>
<?php endif; ?>
<form action="/login" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo old('email'); ?>">
    </div>
    <div>
        <label for="password">Senha</label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit" class="btn btn-primary">Entrar</button>
</form>

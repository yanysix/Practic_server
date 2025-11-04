<div class="profile-container">
    <h2>Личный кабинет</h2>

    <?php if(!empty($message)): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <div class="profile-info">
        <div class="avatar">
            <img src="<?= $user->avatar ?? '/practic_server/public/images/default-avatar.png' ?>" alt="Аватар">
        </div>
        <div class="details">
            <p><strong>Логин:</strong> <?= $user->login ?></p>
            <p><strong>Роль:</strong> <?= $user->role ?></p>
        </div>
    </div>

    <h3>Сменить пароль</h3>
    <form method="post" enctype="multipart/form-data" class="profile-form">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label>
            Новый пароль
            <input type="password" name="password" placeholder="Введите новый пароль">
        </label>

        <label>
            Аватар
            <input type="file" name="avatar" accept="image/*">
        </label>

        <button type="submit">Сохранить</button>
    </form>
</div>

<?php include_once('helpers.php') ?>
<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <?php if (!isset($errors)): ?>
        <nav class="main-navigation">
            <?php foreach ($projects as $project): ?>
                <ul class="main-navigation__list">
                    <li class="main-navigation__list-item">
                        <a class="main-navigation__list-item-link"
                           href="/?id=<?= $project['id']; ?>"><?= htmlspecialchars($project['title']) ?></a>
                        <span
                            class="main-navigation__list-item-count"><?= countTaskFromProject($project, $tasks) ?></span>
                    </li>
                </ul>
            <?php endforeach; ?>
        </nav>
        <a class="button button--transparent button--plus content__side-button"
           href="pages/form-project.html" target="project_add">Добавить проект</a>
    <?php endif; ?>
</section>
<main class="content__main">
    <h2 class="content__main-heading">Добавление задачи</h2>

    <form class="form" action="/add.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="form__row">
            <?php $classname = isset($errors['name']) ? "form__input--error" : ""; ?>
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input<?= $classname ?>" type="text" name="name" id="name"
                   value="<?= getPostVal('name') ?>" placeholder="Введите название">
            <p class="form__message"><?= $errors['name'] ?? ""; ?></p>
        </div>

        <div class="form__row">
            <?php $classname = isset($errors['project']) ? "form__input--error" : ""; ?>
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input<?= $classname ?>" name="project" id="project">
                <?php foreach ($projects as $project): ?>
                    <option value="<?= $project['id'] ?>"><?= $project['title'] ?></option>
                <?php endforeach ?>
            </select>
            <p class="form__message"><?= $errors['name'] ?? ""; ?></p>
        </div>

        <div class="form__row">
            <?php $classname = isset($errors['date']) ? "form__input--error" : ""; ?>
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input <?= $classname ?>" type="text" name="date" id="date"
                   value="<?= getPostVal('date') ?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <p class="form__message"><?= $errors['date'] ?? ""; ?></p>
        </div>

        <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
                <input class="visually-hidden" type="file" name="file" id="file" value="">

                <label class="button button--transparent" for="file">
                    <span>Выберите файл</span>
                </label>
            </div>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="send" value="Добавить">
        </div>
    </form>
</main>
</div>
</div>
</div>



<?php include_once('helpers.php') ?>
<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <?php foreach ($projects as $project): ?>
            <ul class="main-navigation__list">
                <li class="main-navigation__list-item">
                    <a class="main-navigation__list-item-link"
                       href="/?id=<?= $project['id']; ?>"><?= htmlspecialchars($project['title']) ?></a>
                    <span class="main-navigation__list-item-count"><?= countTaskFromProject($project, $tasks) ?></span>
                </li>
            </ul>
        <?php endforeach; ?>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
       href="pages/form-project.html" target="project_add">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="post" autocomplete="off">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/" class="tasks-switch__item">Повестка дня</a>
            <a href="/" class="tasks-switch__item">Завтра</a>
            <a href="/" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox">
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>


    <?php
    foreach ($tasks as $task): ?>
        <table class="tasks">
            <?php if ($task['status'] == 2) continue; ?>
            <?php if ($task ['status'] == 1): ?>
            <tr class="tasks__item task task--completed"><?php endif; ?>
                <?= importantDateRed($task); ?>
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden"
                               type="checkbox" <?php if ($task ['status'] == 1): ?> checked <?php endif; ?>>
                        <span class="checkbox__text"><?= htmlspecialchars($task['title']); ?></span>
                    </label>
                </td>
                <td class="task__file">
                    <?php if ($task['file_link'] != '/uploads/' && $task['file_link'] != ""): ?>
                        <a class="download-link" href="<?= $task['file_link'] ?>">
                            <?= $task['file_link']; ?>
                        </a>
                    <?php endif; ?>
                </td>
                <?php if ($task['dt_compleat'] != null): ?>
                    <td class="task__date"> <?= date("d.m.Y", strtotime($task['dt_compleat'])); ?>
                        <element class="task--important">
                    </td> <?php endif; ?>
                <td class="task__controls">
                </td>
            </tr>
        </table>
    <?php endforeach; ?>
</main>

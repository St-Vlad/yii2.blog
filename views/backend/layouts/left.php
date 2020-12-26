<aside class="main-sidebar">
    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Користувачі', 'icon' => 'user', 'url' => ['/admin/users'], 'active' => $this->context->id == 'user/index'],
                    ['label' => 'Статті', 'icon' => 'file-o', 'url' => ['/admin/articles'], 'active' => $this->context->id == 'articles/index'],
                    ['label' => 'Категорії', 'icon' => 'file-o', 'url' => ['/admin/categories'], 'active' => $this->context->id == 'categories/index'],
                ],
            ]
        ) ?>
    </section>
</aside>

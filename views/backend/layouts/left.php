<aside class="main-sidebar">
    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Users', 'icon' => 'user', 'url' => ['/admin/users'], 'active' => $this->context->id == 'user/index'],
                    ['label' => 'Articles', 'icon' => 'file-o', 'url' => ['/admin/articles'], 'active' => $this->context->id == 'articles/index'],
                    ['label' => 'Categories', 'icon' => 'file-o', 'url' => ['/admin/categories'], 'active' => $this->context->id == 'categories/index'],
                    ['label' => 'Tags', 'icon' => 'file-o', 'url' => ['/admin/tags'], 'active' => $this->context->id == 'tags/index'],
                ],
            ]
        ) ?>
    </section>
</aside>

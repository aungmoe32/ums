<?php require BASE_PATH . 'views/partials/head.php' ?>


<div class="container flex flex-col">

    <h1 class="h10"><?= $heading ?></h1>

    <div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
        <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
            <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                <tr>
                    <th scope="col" class="p-4">ID</th>
                    <th scope="col" class="p-4">Name</th>
                    <th scope="col" class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline dark:divide-outline-dark">
                <?php foreach ($roles as $role) : ?>
                    <tr>
                        <td class="p-4"><?= $role['id'] ?></td>
                        <td class="p-4"><?= $role['name'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</div>

<?php require BASE_PATH . 'views/partials/footer.php' ?>
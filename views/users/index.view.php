<?php require BASE_PATH . 'views/partials/head.php' ?>
<?php require BASE_PATH . 'views/partials/sidebar.php' ?>
<div class="container flex flex-col">

    <h1 class="h10"><?= $heading ?></h1>

    <div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
        <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
            <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                <tr>
                    <th scope="col" class="p-4">ID</th>
                    <th scope="col" class="p-4">Name</th>
                    <th scope="col" class="p-4">Email</th>
                    <th scope="col" class="p-4">Role</th>
                    <th scope="col" class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline dark:divide-outline-dark">
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="p-4"><?= htmlspecialchars($user['id']) ?></td>
                        <td class="p-4"><?= htmlspecialchars($user['name']) ?></td>
                        <td class="p-4"><?= htmlspecialchars($user['email']) ?></td>
                        <td class="p-4">
                            <a href="/roles/show?id=<?= htmlspecialchars($user['role_id']) ?>" class="text-blue-500">
                                <?= htmlspecialchars($user['role']) ?>
                            </a>
                        </td>
                        <td class="p-4">
                            <a href="/users/edit?id=<?= htmlspecialchars($user['id']) ?>" class="text-blue-500">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php require BASE_PATH . 'views/partials/sidebar-footer.php' ?>
<?php require BASE_PATH . 'views/partials/footer.php' ?>
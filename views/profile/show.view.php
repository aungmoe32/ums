<?php require BASE_PATH . 'views/partials/head.php' ?>
<?php require BASE_PATH . 'views/partials/sidebar.php' ?>

<div class="bg-neutral-900 rounded-lg p-6 shadow-lg flex flex-col gap-4">
    <h2 class="text-xl font-semibold mb-4 text-neutral-100">Profile</h2>
    <p class="text-sm text-neutral-300 mb-2">
        <strong>Name:</strong> <?= $user['name'] ?>
    </p>
    <p class="text-sm text-neutral-300 mb-2">
        <strong>Email:</strong> <?= $user['email'] ?>
    </p>
    <p class="text-sm text-neutral-300 mb-2">
        <strong>Role:</strong> <?= $user['role_name'] ?>
    </p>
    <div class="overflow-hidden w-full overflow-x-auto rounded-xl border border-neutral-300 dark:border-neutral-700">
        <table class="w-full text-left text-sm text-neutral-800 dark:text-neutral-300">
            <thead class="border-b border-neutral-300 bg-neutral-200 text-sm text-black dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-100">
                <tr>
                    <th scope="col" class="p-4">Feature</th>
                    <th scope="col" class="p-4">Permissions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                <?php foreach ($permissions as $feature => $perms) : ?>
                    <tr>
                        <td class="p-4"><?= ucfirst($feature) ?></td>
                        <td class="p-4"><?= implode(', ', $perms) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require BASE_PATH . 'views/partials/footer.php' ?>
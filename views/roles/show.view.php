<?php require BASE_PATH . 'views/partials/head.php' ?>
<?php require BASE_PATH . 'views/partials/sidebar.php' ?>

<div class="container flex flex-col">
    <div class="flex justify-between items-center">
        <h1 class="h10">Role Details: <?= htmlspecialchars($role['role_name']) ?></h1>
        <a href="/roles/<?= $role['role_id'] ?>/edit" class="cursor-pointer whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
            Edit Role
        </a>
    </div>

    <div class="mt-6">
        <div class="overflow-hidden w-full overflow-x-auto rounded-xl border border-neutral-300 dark:border-neutral-700">
            <table class="w-full text-left text-sm text-neutral-800 dark:text-neutral-300">
                <thead class="border-b border-neutral-300 bg-neutral-200 text-sm text-black dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-100">
                    <tr>
                        <th scope="col" class="p-4">Feature</th>
                        <th scope="col" class="p-4">Permissions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                    <?php foreach ($role['features'] as $feature => $permissions) : ?>
                        <tr>
                            <td class="p-4"><?= htmlspecialchars($feature) ?></td>
                            <td class="p-4">
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach ($permissions as $permission) : ?>
                                        <span class="rounded-radius w-fit border border-outline bg-surface-alt px-2 py-1 text-xs font-medium text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark">
                                            <?= htmlspecialchars($permission) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require BASE_PATH . 'views/partials/sidebar-footer.php' ?>
<?php require BASE_PATH . 'views/partials/footer.php' ?>
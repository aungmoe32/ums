<?php require BASE_PATH . 'views/partials/head.php' ?>
<?php require BASE_PATH . 'views/partials/sidebar.php' ?>
<?php if (\Core\Session::has('success')) : ?>
    <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible" class="relative w-full overflow-hidden rounded-xl border border-teal-400 bg-neutral-100 text-neutral-800 dark:bg-neutral-800 dark:text-neutral-300" role="alert" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
        <div class="flex w-full items-center gap-2 bg-teal-400/10 p-4">
            <div class="bg-teal-400/15 text-teal-400 rounded-full p-1" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-2">
                <h3 class="text-sm font-semibold text-teal-400"><?= \Core\Session::get('success') ?></h3>
            </div>
            <button type="button" @click="alertIsVisible = false" class="ml-auto" aria-label="dismiss alert">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
<?php endif; ?>
<div class="container flex flex-col">

    <div class="flex justify-between items-center">
        <h1 class="h10"><?= $heading ?></h1>
    </div>

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
                        <td class="p-4 flex gap-2">
                            <?php if (in_array('edit', $permissions['user'])) : ?>
                                <a href="/users/edit?id=<?= htmlspecialchars($user['id']) ?>" class="text-blue-500">Edit</a>
                            <?php endif; ?>
                            <?php if (in_array('delete', $permissions['user'])) : ?>
                                <form action="/users/delete" method="POST">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="text-red-500 cursor-pointer">Delete</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php require BASE_PATH . 'views/partials/sidebar-footer.php' ?>
<?php require BASE_PATH . 'views/partials/footer.php' ?>
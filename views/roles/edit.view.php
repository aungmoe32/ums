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
<?php if (!$canEdit) : ?>
    <div class="container flex flex-col items-center justify-center h-full">
        <h1 class="text-2xl font-semibold text-red-500">You do not have permission to edit roles.</h1>
    </div>
    <?php require BASE_PATH . 'views/partials/sidebar-footer.php' ?>
    <?php require BASE_PATH . 'views/partials/footer.php' ?>
    <?php exit; ?>
<?php endif; ?>

<div class="container flex flex-col">
    <h1 class="h10"><?= $heading ?? 'Edit Role' ?></h1>
    <form action="/roles/update" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $role['id'] ?>">
        <div class="form-group">
            <div class="flex w-full max-w-xs flex-col gap-1 text-neutral-800 dark:text-neutral-300">
                <label for="textInputDefault" class="w-fit pl-0.5 text-sm">Role Name</label>
                <input id="textInputDefault" required type="text" name="role" value="<?= old('role', $role['name']) ?>" class="w-full rounded-xl border border-neutral-300 bg-neutral-200 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-purple-400" placeholder="Enter your role" autocomplete="role" />
            </div>
            <?php if (isset($errors['role'])) : ?>
                <small class="text-red-500"><?= $errors['role'] ?></small>
            <?php endif; ?>
            <?php if (isset($errors['csrf_token'])) : ?>
                <small class="text-red-500"><?= $errors['csrf_token'] ?></small>
            <?php endif; ?>
        </div>
        <div class="mt-5">
            <div class="flex justify-between items-center">
                <h1 class="!text-2xl h10 ">Role Permissions</h1>
            </div>
            <div class="overflow-hidden w-full overflow-x-auto rounded-xl border border-neutral-300 dark:border-neutral-700">
                <table class="w-full text-left text-sm text-neutral-800 dark:text-neutral-300">
                    <thead class="border-b border-neutral-300 bg-neutral-200 text-sm text-black dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-100">
                        <tr>
                            <th scope="col" class="p-4">Feature</th>
                            <th scope="col" class="p-4">Permissions</th>
                            <th scope="col" class="p-4"></th>
                            <th scope="col" class="p-4"></th>
                            <th scope="col" class="p-4"></th>
                            <th scope="col" class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                        <?php foreach ($features as $feature_name => $permissions) : ?>
                            <tr x-data="{selectAll: false}" x-init="$watch('selectAll', value => $el.querySelectorAll('input[name=\'permissions[]\']').forEach(checkbox => checkbox.checked = value))">
                                <td class="p-4">
                                    <?= $feature_name ?>
                                </td>
                                <td class="p-4">
                                    <label class="flex items-center gap-2 text-sm font-medium text-on-surface dark:text-on-surface-dark has-checked:text-on-surface-strong dark:has-checked:text-on-surface-dark-strong has-disabled:cursor-not-allowed has-disabled:opacity-75">
                                        <div class="relative flex items-center">
                                            <input type="checkbox" x-model="selectAll" class="before:content[''] peer relative size-4 appearance-none overflow-hidden rounded-sm border border-outline bg-surface-alt before:absolute before:inset-0 checked:border-primary checked:before:bg-primary focus:outline-2 focus:outline-offset-2 focus:outline-outline-strong checked:focus:outline-primary active:outline-offset-0 disabled:cursor-not-allowed dark:border-outline-dark dark:bg-surface-dark-alt dark:checked:border-primary-dark dark:checked:before:bg-primary-dark dark:focus:outline-outline-dark-strong dark:checked:focus:outline-primary-dark" />
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="4" class="pointer-events-none invisible absolute left-1/2 top-1/2 size-3 -translate-x-1/2 -translate-y-1/2 text-on-primary peer-checked:visible dark:text-on-primary-dark">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        </div>
                                        <span>Select All</span>
                                    </label>
                                </td>
                                <?php foreach ($permissions as $key => $permission) : ?>
                                    <td class="p-4">
                                        <label class="flex items-center gap-2 text-sm font-medium text-on-surface dark:text-on-surface-dark has-checked:text-on-surface-strong dark:has-checked:text-on-surface-dark-strong has-disabled:cursor-not-allowed has-disabled:opacity-75">
                                            <div class="relative flex items-center">
                                                <input type="checkbox" <?= in_array($permission['permission_name'], $rolePermissions[$feature_name] ?? []) ? 'checked' : '' ?> name="permissions[]" value="<?= $permission['permission_id'] ?>" class="before:content[''] peer relative size-4 appearance-none overflow-hidden rounded-sm border border-outline bg-surface-alt before:absolute before:inset-0 checked:border-primary checked:before:bg-primary focus:outline-2 focus:outline-offset-2 focus:outline-outline-strong checked:focus:outline-primary active:outline-offset-0 disabled:cursor-not-allowed dark:border-outline-dark dark:bg-surface-dark-alt dark:checked:border-primary-dark dark:checked:before:bg-primary-dark dark:focus:outline-outline-dark-strong dark:checked:focus:outline-primary-dark" />
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="4" class="pointer-events-none invisible absolute left-1/2 top-1/2 size-3 -translate-x-1/2 -translate-y-1/2 text-on-primary peer-checked:visible dark:text-on-primary-dark">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </div>
                                            <span>
                                                <?= $permission['permission_name'] ?>
                                            </span>
                                        </label>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="flex gap-2 mt-5">
                <button type="submit" class="cursor-pointer whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">Update</button>
            </div>
        </div>
    </form>
</div>
<?php require BASE_PATH . 'views/partials/sidebar-footer.php' ?>
<?php require BASE_PATH . 'views/partials/footer.php' ?>
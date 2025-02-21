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
                    <th scope="col" class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline dark:divide-outline-dark">
                <?php foreach ($roles as $role) : ?>
                    <tr>
                        <td class="p-4"><?= htmlspecialchars($role['role_id']) ?></td>
                        <td class="p-4">

                            <a href="/roles/show?id=<?= htmlspecialchars($role['role_id']) ?>" class="cursor-pointer bg-transparent rounded-radius px-4 py-2 text-sm font-medium tracking-wide text-green-500 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:text-green-400 dark:focus-visible:outline-green-400">
                                <?= htmlspecialchars($role['role_name']) ?>
                            </a>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <?php if (in_array('edit', $permissions['role'])) : ?>
                                    <a href="/roles/edit?id=<?= htmlspecialchars($role['role_id']) ?>" class="cursor-pointer bg-transparent rounded-radius px-4 py-2 text-sm font-medium tracking-wide text-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:text-primary-dark dark:focus-visible:outline-primary-dark">edit</a>
                                <?php endif; ?>

                                <?php if (in_array('delete', $permissions['role'])) : ?>
                                    <div x-data="{deleteModalIsOpen: false}">
                                        <button type="button" x-on:click="deleteModalIsOpen = true" class="cursor-pointer bg-transparent rounded-radius px-4 py-2 text-sm font-medium tracking-wide text-red-500 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:text-red-400 dark:focus-visible:outline-red-400">delete</button>

                                        <div x-cloak x-show="deleteModalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="deleteModalIsOpen" x-on:keydown.esc.window="deleteModalIsOpen = false" x-on:click.self="deleteModalIsOpen = false" class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">
                                            <!-- Modal Dialog -->
                                            <div x-show="deleteModalIsOpen" x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity" x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100" class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-xl border border-neutral-300 bg-neutral-100 text-neutral-800 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                                                <div class="flex items-center justify-between border-b border-outline bg-surface-alt/60 p-4 dark:border-outline-dark dark:bg-surface-dark/20">
                                                    <h3 id="deleteModalTitle" class="font-semibold tracking-wide text-on-surface-strong dark:text-on-surface-dark-strong">Delete Role <?= htmlspecialchars($role['role_name']) ?></h3>
                                                    <button x-on:click="deleteModalIsOpen = false" aria-label="close modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <!-- Dialog Body -->
                                                <div class="px-4 py-8">
                                                    <p class="text-sm text-on-surface dark:text-on-surface-dark">Are you sure you want to delete the role "<?= htmlspecialchars($role['role_name']) ?>"? This action cannot be undone.</p>
                                                    <div class="flex justify-end gap-2 mt-4">
                                                        <button type="button" x-on:click="deleteModalIsOpen = false" class="cursor-pointer bg-transparent rounded-radius px-4 py-2 text-sm font-medium tracking-wide text-neutral-500 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:text-neutral-400 dark:focus-visible:outline-neutral-400">Cancel</button>
                                                        <form action="/roles/delete" method="POST">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="role_id" value="<?= htmlspecialchars($role['role_id']) ?>">
                                                            <button type="submit" class="cursor-pointer bg-red-500 rounded-radius px-4 py-2 text-sm font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-red-400 dark:focus-visible:outline-red-400">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div x-data="{modalIsOpen: false}">
                                    <button type="button" x-on:click="modalIsOpen = true" class="cursor-pointer bg-transparent rounded-radius px-4 py-2 text-sm font-medium tracking-wide text-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:text-primary-dark dark:focus-visible:outline-primary-dark">permissions</button>

                                    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen" x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false" class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                                        <!-- Modal Dialog -->
                                        <div x-show="modalIsOpen" x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity" x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100" class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-xl border border-neutral-300 bg-neutral-100 text-neutral-800 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                                            <div class="flex items-center justify-between border-b border-outline bg-surface-alt/60 p-4 dark:border-outline-dark dark:bg-surface-dark/20">
                                                <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-on-surface-strong dark:text-on-surface-dark-strong">Permissions for <?= htmlspecialchars($role['role_name']) ?></h3>
                                                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <!-- Dialog Body -->
                                            <div class="px-4 py-8">
                                                <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
                                                    <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                                                        <tr>
                                                            <th scope="col" class="p-4">Feature</th>
                                                            <th scope="col" class="p-4">Permissions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-outline dark:divide-outline-dark">
                                                        <?php foreach ($role['features'] as $featureArray) : ?>
                                                            <?php foreach ($featureArray as $feature => $pers) : ?>
                                                                <tr>
                                                                    <td class="p-4"><?= htmlspecialchars($feature) ?></td>
                                                                    <td class="p-4"><?= htmlspecialchars(implode(', ', $pers)) ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</div>

<?php require BASE_PATH . 'views/partials/sidebar-footer.php' ?>
<?php require BASE_PATH . 'views/partials/footer.php' ?>
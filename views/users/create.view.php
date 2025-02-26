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

<?php if (!$canCreate) : ?>
    <div class="container flex flex-col items-center justify-center h-full">
        <h1 class="text-2xl font-semibold text-red-500">You do not have permission to create users.</h1>
    </div>
    <?php require BASE_PATH . 'views/partials/sidebar-footer.php' ?>
    <?php require BASE_PATH . 'views/partials/footer.php' ?>
    <?php exit; ?>
<?php endif; ?>

<div class="container flex flex-col px-10">

    <h1 class="h10"><?= $heading ?></h1>

    <form action="/users" class="mt-5" method="POST">
        <?= csrf_field() ?>
        <div class="flex flex-col space-y-4">
            <div class="flex w-full max-w-xs flex-col gap-1 text-neutral-800 dark:text-neutral-300">
                <label for="textInputDefault" class="w-fit pl-0.5 text-sm">User Name</label>
                <input required type="text" name="name" value="<?= old('name') ?>" class="w-full rounded-xl border border-neutral-300 bg-neutral-200 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-purple-400" name="name" placeholder="Enter your name" autocomplete="name" />
            </div>
            <small class="text-danger"><?= $errors['name'] ?? '' ?></small>

            <div class="flex w-full max-w-xs flex-col gap-1 text-neutral-800 dark:text-neutral-300">
                <label for="textInputDefault" class="w-fit pl-0.5 text-sm">Email</label>
                <input required type="email" name="email" value="<?= old('email') ?>" class="w-full rounded-xl border border-neutral-300 bg-neutral-200 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-purple-400" name="name" placeholder="Enter your name" autocomplete="name" />
            </div>
            <small class="text-danger"><?= $errors['email'] ?? '' ?></small>

            <div class="flex w-full max-w-xs flex-col gap-1 text-neutral-800 dark:text-neutral-300">
                <label for="textInputDefault" class="w-fit pl-0.5 text-sm">Password</label>
                <input required type="password" name="password" value="<?= old('password') ?>" class="w-full rounded-xl border border-neutral-300 bg-neutral-200 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-purple-400" name="name" placeholder="Enter your name" autocomplete="name" />
            </div>
            <small class="text-danger"><?= $errors['password'] ?? '' ?></small>

            <div class="relative flex w-full max-w-xs flex-col gap-1 text-neutral-800 dark:text-neutral-300">
                <label for="os" class="w-fit pl-0.5 text-sm">Assign Role</label>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="absolute pointer-events-none right-4 top-8 size-5">
                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
                <select id="role" name="role" required class="w-full appearance-none rounded-xl border border-neutral-300 bg-neutral-200 px-4 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-purple-400">
                    <option value="" disabled <?= old('role') ? '' : 'selected' ?>>Please Select Role</option>
                    <?php foreach ($roles as $role) : ?>
                        <option value="<?= htmlspecialchars($role['id']) ?>" <?= old('role') == $role['id'] ? 'selected' : '' ?>><?= htmlspecialchars($role['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="flex space-x-4 mt-4">
                <button type="submit" class="cursor-pointer whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">Create</button>
                <button type="submit" name="action" value="create_another" class="cursor-pointer whitespace-nowrap rounded-radius bg-surface-alt border border-surface-alt px-4 py-2 text-sm font-medium tracking-wide text-on-surface-strong transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-surface-alt active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-surface-dark-alt dark:border-surface-dark-alt dark:text-on-surface-dark-strong dark:focus-visible:outline-surface-dark-alt">Create & Create Another</button>

            </div>

        </div>
    </form>


</div>

<?php require BASE_PATH . 'views/partials/sidebar-footer.php' ?>
<?php require BASE_PATH . 'views/partials/footer.php' ?>
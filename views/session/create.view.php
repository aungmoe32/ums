<?php require base_path('views/partials/head.php') ?>

<main class="h-screen">
    <div class="flex min-h-full items-start justify-center py-12 px-4 sm:px-6 lg:px-8 bg-surface-dark">
        <div class="w-full max-w-md space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-on-surface-dark">Log In!</h2>
            </div>

            <form class="mt-8 space-y-6" action="/session" method="POST">
                <?= csrf_field() ?>
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required
                            class="relative block w-full appearance-none rounded-none rounded-t-md border border-outline-dark px-3 py-2 text-on-surface-dark placeholder-on-surface-dark focus:z-10 focus:border-primary-dark focus:outline-none focus:ring-primary-dark sm:text-sm"
                            placeholder="Email address"
                            value="<?= htmlspecialchars(old('email')) ?>">
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required
                            class="relative block w-full appearance-none rounded-none rounded-b-md border border-outline-dark px-3 py-2 text-on-surface-dark placeholder-on-surface-dark focus:z-10 focus:border-primary-dark focus:outline-none focus:ring-primary-dark sm:text-sm"
                            placeholder="Password">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="cursor-pointer group relative flex w-full justify-center rounded-md border border-transparent bg-primary-dark py-2 px-4 text-sm font-medium text-on-primary-dark hover:bg-primary focus:outline-none focus:ring-2 focus:ring-primary-dark focus:ring-offset-2">
                        Log In
                    </button>
                </div>

                <ul>
                    <?php if (isset($errors['email'])) : ?>
                        <li class="text-danger text-xs mt-2"><?= $errors['email'] ?></li>
                    <?php endif; ?>

                    <?php if (isset($errors['password'])) : ?>
                        <li class="text-danger text-xs mt-2"><?= $errors['password'] ?></li>
                    <?php endif; ?>

                    <?php if (isset($errors['csrf_token'])) : ?>
                        <li class="text-danger text-xs mt-2"><?= $errors['csrf_token'] ?></li>
                    <?php endif; ?>
                </ul>
            </form>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
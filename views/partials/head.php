<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">

        @theme {
    /* Light Theme */
    --color-surface: var(--color-neutral-100);
    --color-surface-alt: var(--color-neutral-200);
    --color-on-surface: var(--color-neutral-800);
    --color-on-surface-strong: var(--color-black);
    --color-primary: var(--color-purple-500);
    --color-on-primary: var(--color-white);
    --color-secondary: var(--color-sky-500);
    --color-on-secondary: var(--color-white);
    --color-outline: var(--color-neutral-300);
    --color-outline-strong: var(--color-neutral-800);

    /* Dark Theme */
    --color-surface-dark: var(--color-neutral-800);
    --color-surface-dark-alt: var(--color-neutral-900);
    --color-on-surface-dark: var(--color-neutral-300);
    --color-on-surface-dark-strong: var(--color-neutral-100);
    --color-primary-dark: var(--color-purple-400);
    --color-on-primary-dark: var(--color-black);
    --color-secondary-dark: var(--color-blue-400);
    --color-on-secondary-dark: var(--color-black);
    --color-outline-dark: var(--color-neutral-700);
    --color-outline-dark-strong: var(--color-neutral-300);

    /* Shared Colors */
    --color-info: var(--color-cyan-500);
    --color-on-info: var(--color-black);
    --color-success: var(--color-teal-400);
    --color-on-success: var(--color-black);
    --color-warning: var(--color-yellow-300);
    --color-on-warning: var(--color-black);
    --color-danger: var(--color-pink-500);
    --color-on-danger: var(--color-black);

    /* Border Radius */
    --radius-radius: var(--radius-xl); 
    --font-poppins: 'Poppins', sans-serif; 
    --font-oswald: 'Oswald', sans-serif;
}  

h1,
h2,
h3,
h4,
h5 {
    /* font-family: var(--font-oswald); */
    font-family: var(--font-poppins);

}
body {
    font-family:  var(--font-poppins);
}


@layer utilities {
        .h10 {
            @apply py-4 font-bold text-white text-4xl;
        }
    }
</style>

</head>

<body>
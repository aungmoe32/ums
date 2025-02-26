</body>

<?php if ($_SERVER['REQUEST_URI'] === '/') : ?>
    <footer class="bg-gray-800 text-white py-4 fixed bottom-0 w-full">
        <div class="container mx-auto text-center">
            <p>&copy; <?= date('Y') ?> User Management System. All rights reserved.</p>
            <div class="flex justify-center space-x-4">
                <a href="/privacy" class="text-gray-400 hover:text-gray-300">Privacy Policy</a>
                <a href="/terms" class="text-gray-400 hover:text-gray-300">Terms of Service</a>
            </div>
        </div>
    </footer>
<?php endif; ?>

</html>
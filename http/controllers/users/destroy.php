<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$permissions = App::resolve(Authenticator::class)->permissions();

if (!in_array('delete', $permissions['user'])) {
    redirect('/users');
}

$userId = $_POST['user_id'];

try {
    $db->beginTransaction();

    // Delete the role
    $db->query('DELETE FROM users WHERE id = :id', [
        'id' => $userId
    ]);

    $db->commit();
} catch (\PDOException $e) {
    $db->rollBack();
    // Flash error message and redirect
    \Core\Session::flash('errors', ['database' => 'An error occurred while deleting the user']);
    return redirect('/users');
}

// Flash success message and redirect
\Core\Session::flash('success', 'User deleted successfully!');
redirect('/users');

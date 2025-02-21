<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$roleId = $_POST['role_id'];

try {
    $db->beginTransaction();

    // Delete the role
    $db->query('DELETE FROM roles WHERE id = :id', [
        'id' => $roleId
    ]);

    $db->commit();
} catch (\PDOException $e) {
    $db->rollBack();
    // Flash error message and redirect
    \Core\Session::flash('errors', ['database' => 'An error occurred while deleting the role']);
    return redirect('/roles');
}

// Flash success message and redirect
\Core\Session::flash('success', 'Role deleted successfully!');
redirect('/roles');

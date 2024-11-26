<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gestion des utilisateurs</title>
    <link rel="stylesheet" href="/css/admin.css"> 
  
</head>
<body>
    <div class="container">
        <h1 class="title">Gestion des utilisateurs</h1>

        <!-- Afficher les messages de succès ou d'erreur -->
        <?php if (isset($_SESSION['message'])): ?>
            <p class="message success"><?php echo htmlspecialchars($_SESSION['message']); ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="message error"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <h2 class="subtitle">Utilisateurs normaux</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td>
                            <form action="/Admin/page" method="POST" class="inline-form">
                                <input type="hidden" name="user_id" value="<?php echo $user['id_utilisateur']; ?>">
                                <input type="hidden" name="action" value="change_role">
                                <select name="new_role" class="role-select">
                                    <option value="utilisateur">Utilisateur</option>
                                    <option value="admin">Administrateur</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Modifier le rôle</button>
                            </form>
                            <form action="/Admin/page" method="POST" class="inline-form">
                                <input type="hidden" name="user_id" value="<?php echo $user['id_utilisateur']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="subtitle">Administrateurs</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($admin['email']); ?></td>
                        <td><?php echo htmlspecialchars($admin['role']); ?></td>
                        <td>
                            <form action="/Admin/page" method="POST" class="inline-form">
                                <input type="hidden" name="user_id" value="<?php echo $admin['id_utilisateur']; ?>">
                                <input type="hidden" name="action" value="change_role">
                                <select name="new_role" class="role-select">
                                    <option value="utilisateur">Utilisateur</option>
                                    <option value="admin">Administrateur</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Modifier le rôle</button>
                            </form>
                            <form action="/Admin/page" method="POST" class="inline-form">
                                <input type="hidden" name="user_id" value="<?php echo $admin['id_utilisateur']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
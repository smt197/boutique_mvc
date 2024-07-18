<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Dettes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .btn-blue {
            background-color: #3490dc;
        }

        .btn-blue:hover {
            background-color: #2779bd;
        }
    </style>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Navbar -->
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="text-xl font-semibold text-gray-700">Gestion des Dettes</div>
                <div>
                    <a href="utilisateurs" class="text-gray-700 hover:text-gray-900 mr-4">Accueil</a>
                    <!-- <a href="#" class="text-gray-700 hover:text-gray-900 mr-4">Profil</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Déconnexion</a> -->
                </div>
            </div>
        </nav>
    </header>

    <div class="flex flex-1 ">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-500 text-white p-4 overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4">Menu</h2>
            <nav>
                <div class="mb-4">
                    <!-- <button class="flex items-center justify-between w-full text-lg font-semibold mb-2" onclick="toggleMenu('gestionDette')">
                        Gestion Dette
                        <i class="fas fa-plus"></i>
                    </button> -->
                    <ul id="gestionDette" class="pl-4 hidden">
                        <li><a href="listedette" class="hover:text-gray-300">Liste des dettes</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 2</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 3</a></li>
                    </ul>
                </div>
                <div>
                    <!-- <button class="flex items-center justify-between w-full text-lg font-semibold mb-2" onclick="toggleMenu('gestionClient')">
                        Gestion Client
                        <i class="fas fa-plus"></i>
                    </button> -->
                    <ul id="gestionClient" class="pl-4 hidden">
                        <li><a href="utilisateurs" class="hover:text-gray-300">Enregistrer clients</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 2</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 3</a></li>
                    </ul>
                </div>
            </nav>
        </aside>

        <main class="flex-grow overflow-x-hidden overflow-y-auto bg-gray-100 p-4">
    <div class="mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Paiement d'une dette</h2>

        <?php if (isset($error)) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <?php if (isset($success)) : ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= htmlspecialchars($success) ?></span>
            </div>
        <?php endif; ?>

        <?php if (isset($dette) && isset($utilisateur)) : ?>
            <div class="mb-4 flex justify-between">
                <div>
                    <label class="font-semibold">Client:</label>
                    <span class="ml-2"><?= htmlspecialchars($utilisateur->prenom) ?></span>
                </div>
                <div>
                    <label class="font-semibold">Nom:</label>
                    <span class="ml-2"><?= htmlspecialchars($utilisateur->nom) ?></span>
                </div>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Montant Total:</label>
                <div class="border-b border-gray-400 mt-1"><?= htmlspecialchars($dette->montant_total) ?></div>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Montant versé:</label>
                <div class="border-b border-gray-400 mt-1"><?= htmlspecialchars($dette->montant_verse) ?></div>
            </div>

            <div class="mb-6">
                <label class="font-semibold">Montant Restant:</label>
                <div class="border-b border-gray-400 mt-1"><?= htmlspecialchars($dette->montant_restant) ?? '' ?></div>
            </div>
            <?php if (isset($error)): ?>
                    <div style="color: red; font-weight: bold; margin-bottom: 10px;">
                        <?= htmlspecialchars($error) ?>
                    </div>
            <?php endif; ?>

            <form action="effectuerPaiement" method="POST" class="border rounded-lg p-4">
                <h3 class="text-lg font-semibold mb-4">Montant à Verser</h3>

                <input type="hidden" name="dette_id" value="<?= $dette->id  ?>">

                <div class="mb-4">
                    <label for="montant" class="block mb-2">Montant :</label>
                    <input type="number" id="montant" name="montant" class="w-full border rounded-md px-3 py-2" step="0.01" min="0" max="<?= htmlspecialchars($dette->montant_restant) ?? '' ?>" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-blue-400 text-white px-6 py-2 rounded-md hover:bg-blue-500 transition duration-300"  value="<?=$dette->id ?? '' ?>">
                        Effectuer le paiement
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</main>

    </div>

    <script>
        function toggleMenu(id) {
            const menu = document.getElementById(id);
            const icon = event.currentTarget.querySelector('i');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            } else {
                menu.classList.add('hidden');
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            }
        }
    </script>
</body>

</html>
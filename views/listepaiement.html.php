<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Dettes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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

    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-500 text-white p-4 overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4">Menu</h2>
            <nav>
                <!-- <div class="mb-4">
                    <button class="flex items-center justify-between w-full text-lg font-semibold mb-2" onclick="toggleMenu('gestionDette')">
                        Gestion Dette
                        <i class="fas fa-plus"></i>
                    </button>
                    <ul id="gestionDette" class="pl-4 hidden">
                        <li><a href="listedette" class="hover:text-gray-300">Liste des dettes</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 2</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 3</a></li>
                    </ul>
                </div> -->
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

        <!-- Main Content -->
        <main class="flex-1 p-8">
    <div class="bg-white border border-blue-400 p-8 rounded-lg">
        <h1 class="text-center text-xl font-bold mb-6">Liste des paiements d'une dette</h1>
        <?php if (isset($error)) : ?>
            <div class="text-red-500 text-center mb-4"><?= htmlspecialchars($error) ?></div>
        <?php else : ?>
            <div class="flex justify-between mb-4">
                <div>
                    <span class="font-semibold">Client:</span> <?= htmlspecialchars($utilisateur->nom) ?>
                </div>
                <div>
                    <span class="font-semibold">Montant versé:</span> <?= htmlspecialchars($dette->montant_verse) ?>
                </div>
                <div>
                    <span class="font-semibold">Montant Restant:</span> <?= htmlspecialchars($dette->montant_restant) ?>
                </div>
            </div>
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-blue-400 text-white">
                    <tr>
                        <th class="py-2 px-4 border-b">Date</th>
                        <th class="py-2 px-4 border-b">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paiements as $paiement) : ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center"><?= htmlspecialchars($paiement->date) ?></td>
                            <td class="py-2 px-4 border-b text-center"><?= htmlspecialchars($paiement->montant) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="mt-4 text-right">
                <span class="font-semibold">Montant Total:</span> <?= htmlspecialchars($total_paiements) ?>
            </div>
        <?php endif; ?>
    </div>
</main>






    </div>
    <footer class="bg-gray-800 text-white py-4 mt-auto">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2024 Gestion des Dettes. Tous droits réservés.</p>
        </div>
    </footer>

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
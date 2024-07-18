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

        <!-- Main content -->
        <!-- Main content -->
<!-- Main content -->
<main class="flex-1 p-8">
    <div class="bg-white border border-gray-200 p-8 rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <div class="text-left">
                <?php if (isset($utilisateur)) : ?>
                    <span class="font-semibold text-xl">Client: <?= htmlspecialchars($utilisateur->nom) ?> <?= htmlspecialchars($utilisateur->prenom) ?></span>
                <?php else : ?>
                    <span class="font-semibold text-xl text-red-500">Client non trouvé</span>
                <?php endif; ?>
            </div>
            <div class="text-center">
                <h1 class="text-2xl font-bold mb-2">Liste Articles</h1>
            </div>
            <div class="text-right flex space-x-8">
                <div>
                    <span class="font-semibold text-xl">Montant versé: <?= isset($dette) ? htmlspecialchars($dette->montant_verse) : 'N/A' ?></span>
                </div>
                <div>
                    <span class="font-semibold text-xl">Montant Restant: <?= isset($dette) ? htmlspecialchars($dette->montant_restant) : 'N/A' ?></span>
                </div>
            </div>
        </div>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-blue-400 text-white">
                    <th class="py-2 px-4 border-b text-center">Libelle</th>
                    <th class="py-2 px-4 border-b text-center">Prix</th>
                    <th class="py-2 px-4 border-b text-center">Quantité</th>
                    <th class="py-2 px-4 border-b text-center">Montant</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($articles)) : ?>
                    <?php foreach ($articles as $article) : ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center"><?= htmlspecialchars($article->libelle) ?></td>
                            <td class="py-2 px-4 border-b text-center"><?= htmlspecialchars($article->prix) ?></td>
                            <td class="py-2 px-4 border-b text-center"><?= htmlspecialchars($article->quantite) ?></td>
                            <td class="py-2 px-4 border-b text-center"><?= htmlspecialchars($article->prix * $article->quantite) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="py-2 px-4 text-center text-red-500">Aucun article trouvé pour cette dette.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <!-- Ajout de la pagination -->
        <?php if (isset($totalPages) && $totalPages > 1) : ?>
            <div class="mt-4 flex justify-center">
                <nav class="inline-flex rounded-md shadow">
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <a href="articlesdette/detteId=<?= $detteId ?>/<?= $i ?>" class="px-4 py-2 <?= $i === $currentPage ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' ?> border border-gray-300 text-sm font-medium hover:bg-gray-50">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </nav>
            </div>
        <?php endif; ?>
    </div>
</main>




    </div>
    <footer class="bg-gray-800 text-white py-12 mt-auto">
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
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Dettes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 1</a></li>
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
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 1</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 2</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 3</a></li>
                    </ul>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="p-8 bg-white shadow-md rounded-lg">
                <div class="mb-4">
                    <span class="font-bold">Client:</span>
                    <?php if (isset($utilisateur)) : ?>
                        <span class="ml-2"><?= htmlspecialchars($utilisateur->nom ?? '') ?></span>
                        <span class="ml-2"><?= htmlspecialchars($utilisateur->prenom ?? '') ?></span>
                        <span class="ml-4 font-bold">Enregistrer une nouvelle dette</span>
                </div>
                <div class="mb-4">
                    <span class="font-bold">Téléphone:</span>
                    <span class="ml-4"><?= htmlspecialchars($utilisateur->telephone ?? '') ?></span>
                </div>
                <?php else : ?>
                    <div>
                        <span class="font-bold">Erreur :</span>
                        <span class="ml-2 text-red-500"><?= htmlspecialchars($error ?? 'Utilisateur non trouvé.') ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <form action="rechercherarticle" method="POST" class="mt-4 bg-white p-6 rounded-lg shadow-md">
                <input type="hidden" name="telephoneClient" value="<?= htmlspecialchars($telephone ?? '') ?>">
                <div class="flex items-center space-x-4">
                    <div class="flex-1">
                        <label for="reference" class="block text-sm font-medium text-gray-700">Référence article</label>
                        <input type="text" name="reference" id="reference" placeholder="Référence article" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="<?= htmlspecialchars($reference ?? '') ?>" />
                    </div>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Rechercher</button>
                </div>
            </form>

            <?php if (isset($article)) : ?>
                <form action="ajouterarticle" method="POST" class="mt-4 bg-white p-6 rounded-lg shadow-md">
                    <input type="hidden" name="telephoneClient" value="<?= htmlspecialchars($telephone ?? '') ?>">
                    <input type="hidden" name="reference" value="<?= htmlspecialchars($reference ?? '') ?>">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Libellé</label>
                            <input type="text" value="<?= htmlspecialchars($article->libelle) ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" disabled />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Prix</label>
                            <input type="text" value="<?= htmlspecialchars($article->prix) ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quantité</label>
                            <div class="mt-1 flex">
                                <input type="text" name="quantite" class="block w-full rounded-md border-gray-300 shadow-sm" />
                                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endif; ?>

            <div class="mt-4 bg-white p-6 rounded-lg shadow-md">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Article</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $total = 0; ?>
                        <?php if (isset($articles) && !empty($articles)) : ?>
                            <?php foreach ($articles as $article) : ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($article['libelle'] ?? '') ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($article['prix'] ?? '') ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($article['quantite'] ?? '') ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars((float)$article['prix'] * (int)$article['quantite']) ?></td>
                                </tr>
                                <?php $total += (float)$article['prix'] * (int)$article['quantite']; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap" colspan="4">Aucun article ajouté.</td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap" colspan="3">Total</td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $total ?></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Nouveau conteneur pour les boutons -->
                <div class="mt-4 flex justify-between">
                    <form action="enregistrerdette" method="POST" class="inline">
                        <input type="hidden" name="telephoneClient" value="<?= htmlspecialchars($telephone ?? '') ?>">
                        <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">Enregistrer dettes</button>
                    </form>
                    <form action="effacerarticles" method="POST" class="inline">
                        <input type="hidden" name="telephoneClient" value="<?= htmlspecialchars($telephone ?? '') ?>">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
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

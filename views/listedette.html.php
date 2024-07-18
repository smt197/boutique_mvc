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

        <!-- Contenu principal -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4">Liste des dettes</h1>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-4 border-b">
                        <div class="flex justify-between items-center">
                            <?php if (isset($utilisateur)) : ?>
                                <div>
                                    <span class="font-bold">Nom :</span>
                                    <span class="ml-2"><?= htmlspecialchars($utilisateur->nom) ?></span>
                                </div>
                                <div>
                                    <span class="font-bold">Prénom :</span>
                                    <span class="ml-2"><?= htmlspecialchars($utilisateur->prenom) ?></span>
                                </div>
                                <div>
                                    <span class="font-bold">Téléphone :</span>
                                    <span class="ml-2"><?= htmlspecialchars($utilisateur->telephone) ?></span>
                                </div>
                            <?php else : ?>
                                <div>
                                    <span class="font-bold">Erreur :</span>
                                    <span class="ml-2 text-red-500"><?= htmlspecialchars($error ?? 'Utilisateur non trouvé.') ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="p-4">
        
                        <div class="flex items-center mb-4">
                            <span class="font-bold mr-4">Statut</span>
                            <div class="flex space-x-4">
                                <form action="listedette" method="post" class="flex items-center space-x-4">
                                    <select name="statut" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="non_paye" <?= isset($statut) && $statut == 'non_paye' ? 'selected' : '' ?>>non payé</option>
                                        <option value="paye" <?= isset($statut) && $statut == 'paye' ? 'selected' : '' ?>>payé</option>
                                    </select>
                                    <input type="hidden" name="telephone" value="<?= htmlspecialchars($utilisateur->telephone ?? '') ?>">
                                    <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                        Ok
                                    </button>
                                </form>
                            </div>
                        </div>

                        <table class="w-full">
                            <thead>
                                <tr class="bg-blue-400 text-white">
                                    <th class="py-2 px-4 text-center">Date</th>
                                    <th class="py-2 px-4 text-center">Montant</th>
                                    <th class="py-2 px-4 text-center">Montant Restant</th>
                                    <th class="py-2 px-4 text-center">Paiement</th>
                                    <th class="py-2 px-4 text-center">Liste Paiement</th>
                                    <th class="py-2 px-4 text-center">Articles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($dettes)) : ?>
                                    <?php foreach ($dettes as $dette) : ?>
                                        <tr class="border-b">
                                            <td class="py-2 px-4 text-center"><?= htmlspecialchars($dette->date) ?></td>
                                            <td class="py-2 px-4 text-center"><?= htmlspecialchars($dette->montant_total) ?></td>
                                            <td class="py-2 px-4 text-center"><?= htmlspecialchars($dette->montant_restant) ?></td>
                                            <td class="py-2 px-4 text-center">
        
                                            <form action="paiement" method="POST">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($dette->id) ?>">
                                            <?php
                                        
                                            
                                            ?>
                                                <button class="text-gray-500 hover:text-blue-600 open-modal" type="submit">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </form>
                                            </td>
                                            <td class="py-2 px-4 text-center">
                                                <form action="listepaiement" method="POST">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($dette->id) ?>">
                    
                                                    <button class="text-gray-500 hover:text-blue-600">
                                                        <i class="fa-solid fa-list"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="py-2 px-4 text-center">
                                                <form action="articlesdette" method="POST">
                                                    <input type="hidden" name="articles" value="<?= htmlspecialchars($dette->id) ?>">
                                                        <button class="text-gray-500 hover:text-blue-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                            </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" class="py-2 px-4 text-center text-red-500">Aucune dette trouvée.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php if (isset($error)) : ?>
                            <p class="text-red-500"><?= htmlspecialchars($error) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
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
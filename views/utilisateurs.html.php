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
                <div class="mb-4">
                    <!-- <button class="flex items-center justify-between w-full text-lg font-semibold mb-2" onclick="toggleMenu('gestionDette')">
                        Gestion Dette
                        <i class="fas fa-plus"></i>
                    </button> -->
                    <ul id="gestionDette" class="pl-4 hidden">
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 1</a></li>
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
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 1</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 2</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 3</a></li>
                    </ul>
                </div>
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4">
            <div class="max-w-full mx-auto">
                <div class="flex flex-col md:flex-row mt-10">
                    <div class="w-full md:w-1/2 bg-white p-4 rounded shadow-md mb-4 md:mb-0 md:mr-4">
                        <h2 class="text-xl font-bold mb-4">Nouveau Client</h2>
                    
                        <?php if (isset($success)) : ?>
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 success" role="alert">
                                <p class="text-green-500"><?= htmlspecialchars($success) ?></p>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="utilisateurs" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="nom" class="block text-sm font-medium text-gray-700">Nom:</label>
                                <input type="text" id="nom" name="nom" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Nom client" value="<?= isset($data['nom']) ? htmlspecialchars($data['nom']) : '' ?>">
                                <?php if (isset($errors['nom'])) : ?>
                                    <p class="text-red-500"><?= htmlspecialchars($errors['nom']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-4">
                                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom:</label>
                                <input type="text" id="prenom" name="prenom" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Prénom client" value="<?= isset($data['prenom']) ? htmlspecialchars($data['prenom']) : '' ?>">
                                <?php if (isset($errors['prenom'])) : ?>
                                    <p class="text-red-500"><?= htmlspecialchars($errors['prenom']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                                <input type="text" id="email" name="email" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Email client" value="<?= isset($data['email']) ? htmlspecialchars($data['email']) : '' ?>">
                                <?php if (isset($errors['email'])) : ?>
                                    <p class="text-red-500"><?= htmlspecialchars($errors['email']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-4">
                                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone:</label>
                                <input type="text" id="telephone" name="telephone" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Numéro téléphone" value="<?= isset($data['telephone']) ? htmlspecialchars($data['telephone']) : '' ?>">
                                <?php if (isset($errors['telephone'])) : ?>
                                    <p class="text-red-500"><?= htmlspecialchars($errors['telephone']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-4">
                                <label for="photo" class="block text-sm font-medium text-gray-700">Photo:</label>
                                <input type="file" id="photo" name="photo" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                                <?php if (isset($errors['photo'])) : ?>
                                    <p class="text-red-500"><?= htmlspecialchars($errors['photo']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="px-6 py-2 btn-blue text-white rounded-md">Enregistrer</button>
                            </div>
                            <?php if (isset($errors['general'])) : ?>
                                <p class="text-red-500 mt-4"><?= htmlspecialchars($errors['general']) ?></p>
                            <?php endif; ?>
                        </form>

                    </div>
                    <!-- Suivi Client -->

                    <div class="w-full md:w-1/2 bg-white p-4 rounded shadow-md">
                        <h2 class="text-xl font-bold mb-4">Suivi Client</h2>
                        <form method="POST" action="test" id="searchForm">
                            <div class="mb-4">
                                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone:</label>
                                <div class="flex">
                                    <input type="text" id="telephone" name="telephone" placeholder="Rechercher un client" class="flex-1 p-2 border border-gray-300 rounded-md" value="<?= isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : '' ?>">
                                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md">Ok</button>
                                </div>
                            </div>
                        </form>

                        <!-- Placeholder Skeleton Loader -->
                        <div id="skeleton" class="hidden">
                            <div class="border p-4 rounded-md mb-4 animate-pulse">
                                <div class="flex items-center mb-4">
                                    <div class="h-4 bg-gray-400 rounded w-1/3"></div>
                                    <div class="ml-auto h-8 bg-gray-400 rounded w-1/6"></div>
                                    <div class="ml-2 h-8 bg-gray-400 rounded w-1/6"></div>
                                </div>
                                <div class="flex flex-col md:flex-row items-center mb-4">
                                    <div class="w-full md:w-1/3 mb-4 md:mb-0">
                                        <div class="p-2 w-full border border-gray-300 rounded-md text-center">
                                            <div class="h-32 bg-gray-400 rounded"></div>
                                        </div>
                                    </div>
                                    <div class="w-full md:w-2/3 md:ml-4">
                                        <div class="h-4 bg-gray-400 rounded mb-2"></div>
                                        <div class="h-4 bg-gray-400 rounded mb-2"></div>
                                        <div class="h-4 bg-gray-400 rounded"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="h-4 bg-gray-400 rounded mb-2"></div>
                                    <div class="h-4 bg-gray-400 rounded mb-2"></div>
                                    <div class="h-4 bg-gray-400 rounded"></div>
                                </div>
                            </div>
                        </div>
                    
                        <?php if (isset($utilisateur)) : ?>
                            <div class="border p-4 rounded-md mb-4">
                                <div class="flex justify-end mb-4">
                                    <form action="listedette" method="POST" class="mr-2">
                                        <input type="hidden" name="telephone" value="<?= htmlspecialchars($utilisateur->telephone) ?>">
                                        <button type="submit" name="dette" class="px-4 py-2 bg-blue-500 text-white rounded-md">Dette</button>
                                    </form>
                                    <form action="afficherFormulaire" method="POST">
                                        <input type="hidden" name="telephoneClient" value="<?= htmlspecialchars($utilisateur->telephone)?>">
                                        <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="submit">Nouvelle</button>
                                    </form>


                            
                                </div>
                                <div class="flex flex-col md:flex-row items-center mb-4">
                                    <div class="w-full md:w-1/3 mb-4 md:mb-0">
                                        <div class="p-2 w-full border border-gray-300 rounded-md text-center">
                                            <img src="<?= htmlspecialchars($_ENV['WEBROOT'] . $utilisateur->photo) ?>" alt="Client Image" class="mx-auto">
                                        </div>
                                    </div>
                                    <div class="w-full md:w-2/3 md:ml-4">
                                        <p><span class="font-medium">Nom:</span> <?= htmlspecialchars($utilisateur->nom) ?></p>
                                        <p><span class="font-medium">Prénom:</span> <?= htmlspecialchars($utilisateur->prenom) ?></p>
                                        <p><span class="font-medium">Email:</span> <?= htmlspecialchars($utilisateur->email) ?></p>
                                    </div>
                                </div>
                                <?php if (isset($dettes)) : ?>
                                    <div class="mb-4">
                                        <p><span class="font-medium">Total dettes:</span> <?= number_format($dettes->total_dette, 2) ?> CFA</p>
                                        <p><span class="font-medium">Montant versé:</span> <?= number_format($dettes->total_verse, 2) ?> CFA</p>
                                        <p><span class="font-medium">Montant Restant:</span> <?= number_format($dettes->total_restant, 2) ?> CFA</p>
                                    </div>
                                <?php endif; ?>
                            </div>

                        <?php elseif (isset($error)) : ?>
                            <p class="text-red-500"><?= htmlspecialchars($error) ?></p>
                        <?php endif; ?>
                    </div>

                    <script>
                        document.getElementById('searchForm').addEventListener('submit', function(e) {
                            document.getElementById('skeleton').classList.remove('hidden');
                        });
                    </script>

                </div>
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
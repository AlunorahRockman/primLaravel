<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/tailwind.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Liste</title>
</head>
<body>
    <div class="container mx-auto mt-8">
        <h1 class="bg-gray-900 font-bold text-white rounded-t-xl text-2xl p-4">Liste des Utilisateurs</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 mb-4">{{ session('success') }}</div>
        @endif

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border-b-2 p-2">Photo</th>
                    <th class="border-b-2 p-2">Nom</th>
                    <th class="border-b-2 p-2">Prénom</th>
                    <th class="border-b-2 p-2">Email</th>
                    <th class="border-b-2 p-2">Adresse</th>
                    <th class="border-b-2 p-2">Date de naissance</th>
                    <th class="border-b-2 p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="flex py-2">
                            @if($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}" 
                                alt="{{ $user->name }}" class="w-10 h-10 object-cover border-4 mx-2 border-blue-200 rounded-xl">
                            @else
                                <span>Aucun</span>
                            @endif
                        </td>                        
                        <td class="border-b">{{ $user->name }}</td>
                        <td class="border-b">{{ $user->firstname }}</td>
                        <td class="border-b">{{ $user->email }}</td>
                        <td class="border-b">{{ $user->address }}</td>
                        <td class="border-b">{{ $user->birthDate }}</td>
                        <td class="border-b">
                            <div class="flex justify-center gap-2 items-center">
                                <a href="{{ route('users.edit', $user) }}" class="text-blue-200 hover:text-blue-900 
                                    flex gap-2 items-center mr-2 hover:underline">
                                    <i class="fas fa-edit"></i>Modifier
                                </a>

                                <button class="text-red-200 flex gap-2 items-center hover:text-red-600 
                                    hover:underline delete-button" data-user-id="{{ $user->id }}">
                                    <i class="fas fa-trash-alt"></i>Supprimer
                                </button>
                                
                                {{-- <form action="{{ route('users.destroy', $user->id) }}" method="post" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-red-200 flex gap-2 items-center 
                                    hover:text-red-600 hover:underline">
                                        <i class="fas fa-trash-alt"></i>Supprimer
                                    </button>
                                </form>  --}}
                            </div>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('users.create') }}" class="bg-blue-500 mb-10 text-white px-5 py-2 rounded mt-4 inline-block">
            <i class="fas fa-plus"></i> Ajouter
        </a>
    </div>

    {{-- ! Modal --}}

    <div id="confirmationModal" class="fixed inset-0 z-50 hidden overflow-auto 
        bg-gray-800 bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-8 rounded shadow-lg">
                <p class="text-xl mb-4">Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
                <div class="flex justify-end">
                    <button id="cancelButton" class="bg-gray-500 text-white px-4 
                        py-2 rounded mr-2">Annuler</button>
                    <form id="deleteForm" action="" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="bg-red-500 text-white px-4 
                        py-2 rounded">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ! Modal --}}

    {{-- ! Scripte --}}

    <script>
        // JavaScript pour afficher/cacher la modal et configurer le formulaire de suppression
        document.addEventListener('DOMContentLoaded', function () {
            var modal = document.getElementById('confirmationModal');
            var cancelButton = document.getElementById('cancelButton');
            var deleteForm = document.getElementById('deleteForm');

            // Fonction pour afficher la modal
            function showModal() {
                modal.classList.remove('hidden');
            }

            // Fonction pour cacher la modal
            function hideModal() {
                modal.classList.add('hidden');
            }

            // Écouteur d'événements sur le bouton "Annuler" pour cacher la modal
            cancelButton.addEventListener('click', function (e) {
                e.preventDefault();
                hideModal();
            });

            /* Écouteur d'événements sur le formulaire de suppression
            deleteForm.addEventListener('submit', function (e) {
                var confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");
                
                if (!confirmDelete) {
                    e.preventDefault();
                }
            });*/

            // Écouteur d'événements sur chaque bouton "Supprimer"
            var deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Mettez à jour l'action du formulaire avec l'URL de suppression appropriée
                    var userId = this.getAttribute('data-user-id');
                    deleteForm.action = '/users/' + userId;

                    // Affichez la modal
                    showModal();
                });
            });
        });
    </script>

    {{-- ! scrypte --}}

</body>
</html>

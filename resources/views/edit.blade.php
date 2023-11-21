<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modifier</title>
    <link rel="stylesheet" href="{{ asset('css/tailwind.min.css') }}">
</head>
<body class="bg-gray-900 p-8">

    <div class="max-w-md mx-auto bg-white rounded p-6 shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Modifier un utilisateur</h1>

        @if(session('success'))
            <div class="text-green-500">{{ session('success')}}</div>
        @endif

        @if ($errors->any())
            <div class="text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Nom :</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 p-2 w-full border rounded">
            </div>

            <div class="mb-4">
                <label for="firstname" class="block text-sm font-medium text-gray-600">Prénom :</label>
                <input type="text" name="firstname" id="firstname" value="{{ old('firstname', $user->firstname) }}" class="mt-1 p-2 w-full border rounded">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email :</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 p-2 w-full border rounded">
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-600">Adresse :</label>
                <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" class="mt-1 p-2 w-full border rounded">
            </div>

            <div class="mb-4">
                <label for="birthDate" class="block text-sm font-medium text-gray-600">Date de naissance :</label>
                <input type="date" name="birthDate" id="birthDate" value="{{ old('birthDate', $user->birthDate) }}" class="mt-1 p-2 w-full border rounded">
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-600">Téléphone :</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 p-2 w-full border rounded">
            </div>

            <div class="mb-4">
                <label for="sexe" class="block text-sm font-medium text-gray-600">Sexe :</label>
                <select name="sexe" id="sexe" class="mt-1 p-2 w-full border rounded">
                    <option value="Male" {{ old('sexe', $user->sexe) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('sexe', $user->sexe) == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('sexe', $user->sexe) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            {{-- <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-600">Image :</label>
                <input type="file" name="image" id="image" class="mt-1 p-2 w-full border rounded">
            </div> --}}

            <div class="mb-4">
                <label for="typeCompte" class="block text-sm font-medium text-gray-600">Type de compte :</label>
                <select name="typeCompte" id="typeCompte" class="mt-1 p-2 w-full border rounded">
                    <option value="Admin" {{ old('typeCompte', $user->typeCompte) == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="User" {{ old('typeCompte', $user->typeCompte) == 'User' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 w-full text-white p-2 rounded">Modifier</button>
        </form>
    </div>

</body>
</html>

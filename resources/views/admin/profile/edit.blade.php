<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Profile</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            width: 400px;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.15);
            text-align: center;
        }

        h1 {
            margin-bottom: 25px;
            color: #333;
        }

        .success-message {
            color: green;
            margin-bottom: 20px;
            font-weight: 600;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            text-align: left;
            color: #555;
        }

        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 25px;
            border: 1px solid #ccc;
            border-radius: 6px;
            cursor: pointer;
        }

        button, .btn-delete, .btn-back {
            cursor: pointer;
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        button {
            background-color: #4a6cf7;
            color: #fff;
            margin-bottom: 20px;
            width: 100%;
        }

        button:hover {
            background-color: #1f3fe0;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
            margin-top: 10px;
            width: 100%;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .btn-back {
            background-color: #777;
            color: #fff;
            display: inline-block;
            text-decoration: none;
            margin-top: 15px;
        }

        .btn-back:hover {
            background-color: #555;
        }

        img.profile-picture {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 4px solid #4a6cf7;
            box-shadow: 0 0 8px rgba(74, 108, 247, 0.6);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="profile_picture">Profile Picture:</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*">

            <button type="submit">Update Profile</button>
        </form>

        @if($user->profile_picture)
            <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" class="profile-picture">

            <form action="{{ route('profile.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Delete Profile Picture</button>
            </form>
        @endif

        <a href="{{ route('profile.show', $user->id) }}" class="btn-back">Back to Profile</a>
    </div>
</body>
</html>

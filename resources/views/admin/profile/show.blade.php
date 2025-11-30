<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Profile</title>

    <style>
        body {
            font-family: "Arial", sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-card {
            background: #fff;
            width: 380px;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        h1 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #333;
        }

        .profile-img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #4a6cf7; /* border biru jelas */
            box-shadow: 0 0 8px rgba(74, 108, 247, 0.6); /* bayangan lembut */
            margin-bottom: 15px;
            background-color: #fff;
        }

        .no-picture {
            color: #888;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .btn-edit {
            display: inline-block;
            padding: 10px 20px;
            background: #4a6cf7;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            transition: 0.2s;
        }

        .btn-edit:hover {
            background: #1f3fe0;
        }
    </style>
</head>
<body>
    <div class="profile-card">
        <h1>User Profile</h1>

        @if($user->profile_picture)
            <img src="{{ Storage::url($user->profile_picture) }}" class="profile-img" alt="Profile Picture" />
        @else
            <p class="no-picture">No profile picture uploaded.</p>
        @endif

        <br />
        <a href="{{ route('profile.edit', $user->id) }}" class="btn-edit">Edit Profile</a>
    </div>
</body>
</html>

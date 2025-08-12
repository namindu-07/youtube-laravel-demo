net<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel App</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 20px;
    }
    
    .container {
      max-width: 800px;
      margin: 0 auto;
    }
    
    .card {
      background: white;
      padding: 20px;
      margin: 20px 0;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .card h2 {
      color: #333;
      margin-bottom: 15px;
    }
    
    input, textarea {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
    }
    
    button {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
    }
    
    button:hover {
      background-color: #0056b3;
    }
    
    .logout-btn {
      background-color: #dc3545;
    }
    
    .logout-btn:hover {
      background-color: #c82333;
    }
    
    .delete-btn {
      background-color: #dc3545;
      padding: 5px 10px;
      font-size: 12px;
    }
    
    .post-item {
      background: #f8f9fa;
      padding: 15px;
      margin: 10px 0;
      border-radius: 4px;
      border-left: 3px solid #007bff;
    }
    
    .auth-forms {
      display: flex;
      gap: 20px;
    }
    
    .auth-forms .card {
      flex: 1;
    }
    
    @media (max-width: 600px) {
      .auth-forms {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    @auth
    <div class="card">
      <h2>Welcome! You are logged in.</h2>
      <form action="/logout" method="POST" style="display: inline;">
        @csrf
        <button class="logout-btn">Log out</button>
      </form>
    </div>

    <div class="card">
      <h2>Create a New Post</h2>
      <form action="/create-post" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Post title" required>
        <textarea name="body" placeholder="Body content..." required></textarea>
        <button>Save Post</button>
      </form>
    </div>

    <div class="card">
      <h2>All Posts</h2>
      @foreach($posts as $post)
      <div class="post-item">
        <h3>{{$post['title']}} by {{$post->user->name}}</h3>
        <p>{{$post['body']}}</p>
        <p>
          <a href="/edit-post/{{$post->id}}">Edit</a>
          <form action="/delete-post/{{$post->id}}" method="POST" style="display: inline; margin-left: 10px;">
            @csrf
            @method('DELETE')
            <button class="delete-btn">Delete</button>
          </form>
        </p>
      </div>
      @endforeach
    </div>

    @else
    <div class="auth-forms">
      <div class="card">
        <h2>Register</h2>
        <form action="/register" method="POST">
          @csrf
          <input name="name" type="text" placeholder="Name" required>
          <input name="email" type="email" placeholder="Email" required>
          <input name="password" type="password" placeholder="Password" required>
          <button>Register</button>
        </form>
      </div>
      
      <div class="card">
        <h2>Login</h2>
        <form action="/login" method="POST">
          @csrf
          <input name="loginname" type="text" placeholder="Name" required>
          <input name="loginpassword" type="password" placeholder="Password" required>
          <button>Log in</button>
        </form>
      </div>
    </div>
    @endauth
  </div>
</body>
</html>
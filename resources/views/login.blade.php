<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-style.css">
    <title>Login Page</title>
</head>
<body>

<div class="center">
    <h1>Sign in</h1>

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <div class="form">

            @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif

            @error('identifier')
                <p class="login-message">{{ $message }}</p>
            @enderror

            <label for="identifier">Email</label>
            <input id="identifier" type="email" name="identifier" class="textfield" placeholder="Email" value="{{ old('identifier') }}" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" class="textfield" placeholder="Password" required>

            <input type="submit" name="login" value="Login" class="btn">

        </div>

    </form>

</div>

</body>
</html>

<style>
  body
{
  
  background-color: #f4f4f4;
  margin: 0;
  padding: 0;
}

.center
{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
}

.center h1
{
  text-align: center;
  margin-bottom: 20px;
}

.form
{
  width: 100%;
  max-width: 400px;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.textfield
{
  box-sizing: border-box;
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.btn
{
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.btn:hover
{
  background-color: green;
}

.login-message
{
  color: #b42318;
}

.success-message
{
  color: #167a35;
}

.login-help
{
  margin-top: 4px;
  color: #555;
  font-size: 0.9rem;
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/icons/files/font/bootstrap-icons.min.css') }}"> --}}
</head>
<style>
    body {
      /* background: linear-gradient(to right, #4facfe, #00f2fe); */
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Arial', sans-serif;
    }
    .card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }
    .card-header {
      background: linear-gradient(to right, #00c6ff, #0072ff);
      color: white;
      text-align: center;
      padding: 2rem;
    }
    .card-header h4 {
      font-size: 1.8rem;
      margin-bottom: 0.5rem;
    }
    .card-header p {
      font-size: 0.9rem;
      opacity: 0.8;
    }
    .input-group-text {
      background-color: #f1f1f1;
      border: none;
    }
    .form-control {
      border: none;
      border-bottom: 2px solid #ddd;
      border-radius: 0;
      box-shadow: none;
    }
    .form-control:focus {
      border-color: #0072ff;
      box-shadow: none;
    }
    .btn-primary {
      background: linear-gradient(to right, #0072ff, #00c6ff);
      border: none;
      font-weight: bold;
      transition: background 0.3s ease;
    }
    .btn-primary:hover {
      background: linear-gradient(to right, #0056cc, #0099dd);
    }
    .form-check-label {
      font-size: 0.85rem;
    }
    .card-footer {
      background-color: #f9f9f9;
      text-align: center;
      font-size: 0.9rem;
    }
    .card-footer a {
      color: #0072ff;
      text-decoration: none;
      font-weight: bold;
    }
    .card-footer a:hover {
      text-decoration: underline;
    }
  </style>
<body>
    @yield('content')
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</html>
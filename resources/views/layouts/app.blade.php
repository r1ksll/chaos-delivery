<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CHAOS - Доставка из ресторанов</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        .header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .logo a {
            color: #e94560;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s;
        }
        .logo a:hover {
            color: #ff6b6b;
        }
       
        .city-selector label {
            font-size: 14px;
            opacity: 0.8;
        }
        .city-selector select {
            padding: 10px 15px;
            border-radius: 10px;
            border: none;
            font-size: 14px;
            background: #e94560;
            cursor: pointer;
            font-weight: 500;
            color: #ffffff;
        }
        .nav-links {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.3s;
            padding: 8px 12px;
            border-radius: 8px;
        }
        .nav-links a:hover {
            color: #e94560;
            background: rgba(255,255,255,0.1);
        }
        .cart-link {
            background: rgba(233,69,96,0.2);
            border-radius: 30px;
        }
        .cart-link:hover {
            background: #e94560;
            color: white !important;
        }
        .user-name {
            background: rgba(233,69,96,0.3);
            border-radius: 30px;
            font-weight: 500;
        }
        .btn-login, .btn-register {
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
        }
        .btn-login {
            background: transparent;
            border: 2px solid #e94560;
        }
        .btn-login:hover {
            background: #e94560;
            color: white !important;
        }
        .btn-register {
            background: #e94560;
        }
        .btn-register:hover {
            background: #ff6b6b;
            color: white !important;
        }
        .btn-logout {
            background: transparent;
            border: 1px solid #e94560;
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 15px;
            transition: all 0.3s;
        }
        .btn-logout:hover {
            background: #e94560;
        }
        
        .footer {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            padding: 40px 0;
            margin-top: 50px;
        }
        .footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .footer-logo {
            font-size: 24px;
            font-weight: bold;
            color: #e94560;
        }
        .footer-phone {
            font-size: 22px;
            font-weight: bold;
            color: #e94560;
        }
        .footer-cities {
            display: flex;
            gap: 25px;
        }
        .footer-cities span {
            padding: 5px 15px;
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin: 30px 0;
        }
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-card .info {
            padding: 15px;
        }
        .product-card .name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }
        .product-card .price {
            color: #e94560;
            font-size: 20px;
            font-weight: bold;
        }
        .restaurants-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin: 20px 0;
        }
        .restaurant-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .restaurant-card:hover {
            transform: translateY(-5px);
        }
        .restaurant-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .restaurant-card div {
            padding: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }
        .categories {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin: 20px 0;
        }
        .categories a {
            background: linear-gradient(135deg, #e94560 0%, #ff6b6b 100%);
            color: white;
            padding: 10px 30px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 500;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .categories a:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(233,69,96,0.4);
        }
        h2 {
            margin: 30px 0 15px 0;
            color: #1a1a2e;
            font-size: 28px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 20px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .btn {
            padding: 10px 25px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
        }
        .btn-primary {
            background: linear-gradient(135deg, #e94560 0%, #ff6b6b 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(233,69,96,0.4);
        }
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        @media (max-width: 768px) {
            .products-grid, .restaurants-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .header .container {
                flex-direction: column;
            }
            .footer .container {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div class="logo">
            <a href="/">CHAOS</a>
        </div>
        
    </div>
            
            <div class="nav-links">
                <div class="city-selector">
            <select id="city-select" onchange="changeCity(this.value)">
                <option value="Ижевск" {{ session('city', 'Ижевск') == 'Ижевск' ? 'selected' : '' }}> Ижевск</option>
                <option value="Казань" {{ session('city', 'Ижевск') == 'Казань' ? 'selected' : '' }}> Казань</option>
            </select>
        </div>
                <a href="{{ route('cart.index') }}" class="cart-link"> Корзина</a>
                
                @auth
                    <a href="{{ route('profile') }}" class="user-name"> {{ Auth::user()->name }}</a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.index') }}"> Админ-панель</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn-logout"> Выйти</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-login"> Войти</a>
                   
                @endauth
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-logo"> CHAOS</div>
            <div class="footer-phone"> +444-444-44-44</div>
            <div class="footer-cities">
                <span>Ижевск</span>
                <span>Казань</span>
            </div>
        </div>
    </footer>

    <script>
        function changeCity(city) {
            fetch('/set-city', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({city: city})
            }).then(() => location.reload());
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Card</title>
    <link rel="stylesheet" href="frontend/css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="container">
        <div class="row">
            {{-- @foreach ( as )   --}}
            <div class="card">
                <div class="card__heart">
                    <i class='bx bx-heart'></i>
                </div>
                <div class="card__cart">
                    <i class='bx bx-cart'></i>
                </div>
                <div class="card__content">
                    <div class="card__img">
                        <img src="frontend/img/product/iphone_15_pro.png" alt="">
                    </div>
                    <div class="card__title">
                        iPhone 15 Pro
                       {{-- {{$cart->tittle }} --}}
                    </div>
                    <div class="card__price">
                        {{-- {{ $cart->price }} --}}
                    </div>
                </div>
                <div class="card__color">
                    <h3>Color: </h3>
                    <span class="card__color--white"></span>
                    <span class="card__color--black"></span>
                    <span class="card__color--red"></span>
                </div>
                <div class="card__action">
                    <button>Buy Now</button>
                    <button>Add to Cart</button>
                </div>
            </div>
            {{-- @endforeach --}}
        </div>
    </div>
</body>

</html>

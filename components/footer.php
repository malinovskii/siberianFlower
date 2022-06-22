
    <!-- Footer -->
    <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-muted">© 2022 Siberian Flower</p>
    
        <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        </a>
    
        <ul class="nav col-md-4 justify-content-end">
        
        <li class="nav-item"><a href="about.php" class="nav-link px-2 text-muted">О нас</a></li>
        <li class="nav-item"><a href="delivery.php" class="nav-link px-2 text-muted">Доставка</a></li>
        <li class="nav-item"><a href="promotions.php" class="nav-link px-2 text-muted">Акции</a></li>
        <li class="nav-item"><a href="catalog.php" class="nav-link px-2 text-muted">Каталог</a></li>
        </ul>
    </footer>
    </div>
    <!-- end footer -->

    <!-- Cart modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Корзина</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php if(!empty($_SESSION['cart'])):?>
                <?php $cart_counter = 0;?>
                <?php foreach($_SESSION['cart'] ?? [] as $item):?>

                    <?php 
                        $cart_counter += 1;
                        $cart_item = $product->getProductById($item)[0];
                    ?>

                    <div class="cart_item py-4 d-flex justify-content-between">
                        <div class="cart_item_info">
                            <h4><?php echo $cart_counter?>. <?php echo $cart_item['name']?></h4>
                            <p class="fs-4"><?php echo $cart_item['price']?> р/шт</p>
                        </div>
                        <div class="cart_item_image">
                            <img src="../assets/img/product/<?php echo $cart_item['image']?>" alt="" style="object-fit: cover; height: 100px; width: 100px">
                        </div>
                        
                    </div>
                    <?php if($cart_item['id'] != end($_SESSION['cart'])):?>
                            <hr>
                    <?php endif?>
                <?php endforeach?>
            <?php else:?>
                Ваша корзина пуста
            <?php endif ?>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Продолжить покупки</button>
            <button type="button" class="btn btn-primary">Оформить заказ</button>
        </div>
        </div>
    </div>
    </div>




    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
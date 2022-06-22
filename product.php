<?php 

require "components/header.php";

$product_item = $product->getProductById($_GET['id'])[0];

$reviews_array = $product->getReviews($_GET['id']);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['add_to_cart'])){
        $Cart->addToCart($_POST['product_id']);
        header('Location: ' . $_SERVER['PHP_SELF'] . "?id={$_POST['product_id']}" );
    }

    if(isset($_POST['add_review'])){
        $product->createReview($_POST['name'], $_POST['review_text'], $_POST['stars'], $_GET['id']);
        header('Location: ' . $_SERVER['PHP_SELF'] . "?id={$_POST['product_id']}" );
    }
   
}
?>




<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <img src="assets/img/product/<?php echo $product_item['image']?>" alt="product_image" style="width: 100%; height: 500px; object-fit: cover">
        </div>
        <div class="col-lg-7 p-4">
            <small>
                Артикул <?php echo $product_item['vendor']?>
            </small>
            <h1 class="mt-3 d-flex align-items-center">
            <?php echo $product_item['name']?>
            <?php if($product_item['in_stock'] == 1):?>
                <span class="fs-5 text-success">
                    &nbsp;&nbsp;В наличии
                </span>
            <?php else: ?>
                <span class="fs-5 text-danger">
                    &nbsp;&nbsp;Нет в наличии
                </span>
            <?php endif; ?>
            </h1>
            <div class="rating d-flex align-items-center">
                <p class="mt-3 mr-3 fs-5">
                    <?php if($product->getReviews($_GET['id'])):?>
                        <?php echo count($product->getReviews($_GET['id']))?>
                        <?php if(count($product->getReviews($_GET['id'])) == 1): ?>
                            отзыв
                        <?php elseif(count($product->getReviews($_GET['id'])) > 1 && count($product->getReviews($_GET['id'])) < 5):?>
                            отзыва
                        <?php else: ?>
                            отзывов
                        <?php endif ?>
                    <?php else: ?>
                        0 отзывов
                    <?php endif?>&nbsp;&nbsp;&nbsp;</p>





                <?php 
                // Calculate Rating
                $product_rating = 0;
                
                $rating_sum = 0;
                
                if($product->getReviews($_GET['id'])){
                    foreach($product->getReviews($_GET['id']) as $item){
                        $rating_sum += $item['rating'];
                    }

                    $product_rating = $rating_sum / count($product->getReviews($_GET['id']));
                }

                // end calculate rating
                ?>
                <div class="Stars" style="--rating: <?php echo $product_rating?>;" aria-label="Rating of this product is 2.3 out of 5.">
                </div>
            </div>
            <p class="mt-3 display-6"><?php echo $product_item['price']?> р/шт </p>
            <form method="post" action="product.php">
                <input type="hidden" name="product_id" value="<?php echo $_GET['id']?>">
                <?php if (in_array($product_item['id'], $_SESSION['cart'] ?? [])):?>
                    <button type="submit" name="delete_from_cart" class="btn btn-lg btn-danger mt-3">Убрать из корзины</button>
                <?php else: ?>
                    
                    <button type="submit" name="add_to_cart" class="btn btn-lg btn-success mt-3" <?php if($product_item['in_stock'] == 0){echo 'disabled';}?>>Добавить в корзину</button>
                <?php endif?>
            </form>
            
        </div>
    </div>
    <div class="row mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Описание</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Отзывы</button>
            </li>
            
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <p class="p-4 lead">
                <?php echo $product_item['info']?>
                </p>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="row">
                    <?php if($reviews_array):?>
                        <div class="col-lg-6">
                            <?php foreach($reviews_array as $review):?>
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Отзыв от <b><?php echo $review['name']?></b> (<?php echo $review['rating']?> из 5)
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                        <p><?php echo $review['text']?></p>
                                        
                                        </blockquote>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="col-lg-6">
                            <p class="p-4">Пока отзывов на этот товар нет, будьте первым!</p>  
                        </div>
                    <?php endif?>
                    <div class="col-lg-6 p-3">
                        <?php if(isset($_SESSION['user'])):?>
                        <h2 class="mt-3">
                            Оставьте свой отзыв
                        </h2>
                        <form method="post" class="mt-4">
                            <input type="hidden" name="product_id" value="<?php echo $_GET['id']?>">
                            <div class="form-group">
                                <label for="name" >Ваше имя</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId">
                            
                            </div>
                            <div class="form-group mt-3">
                                
                                <div class="form-group">
                                  <label for="review_text">Ваш отзыв</label>
                                  <textarea class="form-control" name="review_text" id="review_text" rows="3"></textarea>
                                </div>
                            </div>
                            <label for="rating" class="mt-3">Ваша оценка (от 1 до 5)</label><br>
                            <div class="rating">
                                <label>
                                    <input type="radio" name="stars" value="1" />
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="2" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="3" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>   
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="4" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="stars" value="5" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                            </div><br>
                            <button type="submit" name="add_review" class="btn btn-primary mt-3">Отправить</button>
                        </form>
                        <?php else: ?>
                            <div class="alert alert-primary" role="alert">
                                Чтобы оставить отзыв, <a href="login.php">войдите</a> или <a href="register.php">зарегистрируйтесь</a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>

<?php require "components/footer.php"?>
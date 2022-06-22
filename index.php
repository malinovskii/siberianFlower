<?php require "components/header.php"?>

    <div class="container">
        <div class="p-4 mb-4 rounded-3" style="background-image: url('assets/img/main-bg.jpg'); background-size: cover;">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold text-white">Садовые растения со скидкой<br> от Siberian Flower</h1>
                <a href="catalog.php" class="btn btn-primary btn-lg mt-5">Выбрать растение</a>
            </div>
        </div>
        
        <h2 class="mt-5">Рекомендуем</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 py-5">
            <?php foreach(array_slice($product_array, 0, 3) as $item):?>
            <div class="col">
                <div class="card shadow-sm">
                    <img class="card-img-top" src="assets/img/product/<?php echo $item['image']?>" style="height: 200px; object-fit: cover;"></img>
                    <div class="card-body">
                        <small class="text-muted">Артикул <?php echo $item['vendor']?>&nbsp;| 
                        <?php if($item['in_stock'] == 0):?>
                            <span class="text-danger"> Нет в наличии<span>
                        <?php else: ?>
                            <span class="text-success"> В наличии<span>
                        <?php endif; ?>
                        </small>
                        <h5 class="card-title mt-2"><?php echo $item['name']?></h5>
                        <p class="card-text"><?php echo $item['price']?> Р/шт</p>
                        <div class="d-flex justify-content-between align-items-center">
                            
                            <a href="product.php?id=<?php echo $item['id']?>" class="btn btn-primary">Подробнее</a>
                            
                          
                          <small class="text-muted">
                            <?php if($product->getReviews($item['id'])):?>
                                <?php echo count($product->getReviews($item['id']))?>
                                <?php if(count($product->getReviews($item['id'])) == 1): ?>
                                    отзыв
                                <?php elseif(count($product->getReviews($item['id'])) > 1 && count($product->getReviews($item['id'])) < 5):?>
                                    отзыва
                                <?php else: ?>
                                    отзывов
                                <?php endif ?>
                            <?php else: ?>
                                0 отзывов
                            <?php endif?>
                            </small>
                      </div>
                        
                    </div>
                </div>
            </div>
            <?php endforeach?>
        </div>
    </div>

<?php require "components/footer.php"?>
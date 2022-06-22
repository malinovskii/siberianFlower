<?php 

require "components/header.php";

// Is it necessary to put it somewhere else or not... 
if(isset($_POST['search'])){
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM `product` WHERE CONCAT(`name`, `vendor`, `price`) LIKE '%" . $valueToSearch . "%'";

    $search_result = $db->connection->query($query);

} else {
    $query = "SELECT * FROM `product`";
    $search_result = $db->connection->query($query);
}



?>

<div class="container">
    <div class="row mt-5 d-flex justify-content-between">
        <div class="col-lg-9">
            <h2>Каталог</h2>
        </div>
        <div class="col-lg-3">
            <form class="input-group" method="post">
                    <input type="text" class="form-control" placeholder="Название, артикул, цена..." aria-label="Search by name..." aria-describedby="button-addon2" name="valueToSearch">
                    <button class="btn btn-success" type="submit" id="search_btn" name="search">Найти</button>
            </form>
        </div>
       
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 py-5">
        <?php while($item = mysqli_fetch_array($search_result)):?>
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
        <?php endwhile ?>
    </div>
</div>

<?php require "components/footer.php"?>
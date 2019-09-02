<?php
    $families = $data->getFamilies();
?>
<style>
 .primary-img {
     width : 200px;
     height : 200px;
 }
</style>
<?php if($scope["config"]["software"] == "Cart"): ?>
<div class="heading-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="index.php#/?page=forms&action=products">Products</a></li>
                    <?php if(key_exists("family", $_GET)): ?>
                        <li><a href="<?php echo $linksMaker->makeFamilyLink($_GET["family"]); ?>">Categories</a></li>
                    <?php endif ?>
                    <?php if(key_exists("category", $_GET)): ?>
                        <li class="active"><a href="<?php echo $linksMaker->makeCategoryLink($_GET["category"]); ?>">Items</a></li>
                    <?php endif; ?>
                    <?php if(key_exists("item", $_GET)): ?>
                        <li class="active"><a href="<?php echo $linksMaker->makeItemLink($_GET["item"]); ?>">Item</a></li>
                    <?php endif ?>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- heading-banner end -->
<?php endif; ?>
<!-- shop-area start -->
<div class="shop-area">
    <div class="container">
        <div class="row">
            <?php require __DIR__ . "/products/" . $scope["config"]["software"] . ".php"; ?>
            <!-- shop-content end -->
        </div>
    </div>
</div>

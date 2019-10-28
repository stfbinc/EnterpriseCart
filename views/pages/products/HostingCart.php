<?php if(key_exists("item", $_GET)): ?>
    <?php
        $_GET["family"] = "Cloud";
        $_GET["category"] = "Software";
        $categories = $data->getCategories($_GET["family"]);
        $items = $data->getItems($_GET["category"]);
    ?>
    <div class="row shop-list">
        <!-- single-product start -->
        <!-- single-product start -->
        <?php foreach($items as $itemName=>$item): ?>
            <?php if($item->ItemID == $_GET["item"]): ?>
                <div class="col-md-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="<?php echo $linksMaker->makeItemLink($item->ItemID); ?>">
                                <img class="primary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                                <img class="secondary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                            </a>
                        </div>
                        <div class="product-info">
                            <h3>
                                <a href="<?php echo $linksMaker->makeItemLink($item->ItemID); ?>"><?php echo $item->ItemName; ?></a></h3>
                            <div class="pro-price">
                                Price: <span class="normal"><?php echo formatCurrency($item->Price); ?></span>
                                <br style="margin-bottom:20px" />
                                Qty: <input id="itemSingleQty" type="number" style="width:60px" value=0 />
                                <div class="product-desc">
                                    <!-- <p>
                                         <?php echo $item->ItemDescription; ?></p> -->
                                    <p>
                                        <?php echo $item->ItemLongDescription; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="product-action">
                            <div class="pro-button-top">
                                <a href="javascript:shoppingCartAddItem('<?php echo $item->ItemID; ?>', $('#itemSingleQty').val());">add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <!-- left-sidebar start -->
<?php else: ?>
    <?php
        $_GET["family"] = "Cloud";
        $_GET["category"] = "Software";
        $categories = $data->getCategories($_GET["family"]);
        $priceSort = key_exists("pricesort", $_GET) ? $_GET["pricesort"] : "fromlow";
        $items = $data->getItems("Software");
        //        $sortedItems = [];
        function itemSortLow($a, $b){
            if($a->Price == $b->Price)
                return 0;
            else
                return ($a->Price < $b->Price) ? -1 : 1;
        }

        function itemSortHigh($a, $b){
            if($a->Price == $b->Price)
                return 0;
            else
                return ($a->Price > $b->Price) ? -1 : 1;

        }

        if($priceSort == "fromlow")
            usort($items, "itemSortLow");
        else
            usort($items, "itemSortHigh");

        //      echo json_encode($categories);
    ?>
    <!-- shop-content start -->
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="shop-content">
            <!-- Nav tabs -->
            <ul class="shop-tab" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                           data-toggle="tab"><i class="fa fa-th"></i></a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                    <i class="fa fa-list"></i></a></li>
            </ul>
            <!-- <div class="show-result">
                 <p>
                 Showing 1&ndash;12 of 19 results</p>
                 </div> -->
            <div class="toolbar-form">
                <form action="#">
                    <div class="tolbar-select">
                        <select id="pricesortSelector">
                            <?php if($priceSort == "fromlow"): ?>
                                <option value="fromlow">Sort by Price: low to high</option>
                                <option value="fromhigh">Sort by Price: high to low</option>
                            <?php else: ?>
                                <option value="fromhigh">Sort by Price: high to low</option>
                                <option value="fromlow">Sort by Price: low to high</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </form>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="row">
                        <!-- single-product start -->
                        <?php foreach($items as $itemName=>$item): ?>
                            <?php if($item->CartItem): ?>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="<?php echo $linksMaker->makeItemLink($item->ItemID); ?>">
                                                <img class="primary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                                                <img class="secondary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action">
                                            <div class="pro-button-top">
                                                <a href="javascript:shoppingCartAddItem('<?php echo $item->ItemID; ?>');">add to cart</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h3>
                                                <a href="<?php echo $linksMaker->makeItemLink($item->ItemID); ?>"><?php echo $item->ItemName; ?></a></h3>
                                            <div class="pro-price">
                                                <span class="normal"><?php echo formatCurrency($item->Price); ?></span>
                                            </div>
                                            <div class="product-desc">
                                                <p>
                                                    <?php echo $item->ItemDescription; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="row shop-list">
                        <!-- single-product start -->
                        <!-- single-product start -->
                        <?php foreach($items as $itemName=>$item): ?>
                            <?php if($item->CartItem): ?>
                                <div class="col-md-12">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="<?php echo $linksMaker->makeItemLink($item->ItemID); ?>">
                                                <img class="primary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                                                <img class="secondary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action">
                                            <div class="pro-button-top">
                                                <a href="javascript:shoppingCartAddItem('<?php echo $item->ItemID; ?>');">add to cart</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h3>
                                                <a href="<?php echo $linksMaker->makeItemLink($item->ItemID); ?>"><?php echo $item->ItemName; ?></a></h3>
                                            <div class="pro-price">
                                                <span class="normal"><?php echo formatCurrency($item->Price); ?></span>
                                                <div class="product-desc">
                                                    <p>
                                                        <?php echo $item->ItemDescription; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- <div class="shop-pagination">
                 <div class="pagination">
                 <ul>
                 <li class="active">1</li>
                 <li><a href="#">2</a></li>
                 <li><a href="#">3</a></li>
                 <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                 </ul>
                 </div>
                 </div> -->
        </div>
        <script>
         var pricesortSelector = $("#pricesortSelector");
         pricesortSelector.change(function(){
             window.location = "<?php echo $linksMaker->makeProductsLink(); ?>&pricesort=" + pricesortSelector.val();
             //             onlocation(window.location + "&pricesort=" + pricesortSelector.val());
             //           console.log(pricesortSelector.val());
         });
        </script>
    </div>
<?php endif; ?>

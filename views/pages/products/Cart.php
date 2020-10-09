<?php if(key_exists("item", $_GET)): ?>
    <?php
        $categories = $data->getCategories($_GET["family"]);
        $items = $data->getItems($_GET["category"]);
    ?>
    <div class="row shop-list">
        <!-- single-product start -->
        <!-- single-product start -->
        <?php foreach($items as $itemName=>$item): ?>
            <?php if($itemName == $_GET["item"]): ?>
                <div class="col-md-12">
                    <div class="single-product">
                        <div class="product-img col-md-3">
                            <a href="<?php echo $linksMaker->makeItemLink($itemName); ?>">
                                <img class="primary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                                <img class="secondary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                            </a>
                        </div>
                        <div class="product-info col-md-9">
                            <h3 class="col-md-1">
                                Item:
                            </h3>
                            <h3 class="col-md-11">
                                <a href="<?php echo $linksMaker->makeItemLink($itemName); ?>"><?php echo $itemName; ?></a>
                            </h3>
                            <div class="pro-price">
                                <div style="margin-top:10px;">
                                    <div class="col-md-1">
                                        Price:
                                    </div>
                                    <span class="normal col-md-11"><?php echo formatCurrency($item->Price); ?></span>
                                </div>
                                <div>
                                    <div class="col-md-1" style="margin-top:10px">
                                        Qty:
                                    </div>
                                    <div class="col-md-11" style="margin-top:10px">
                                        <input id="itemSingleQty" type="number" style="width:60px" value=1 />
                                    </div>
                                </div>
                                <div class="product-desc col-md-12" style="margin-top:10px;">
                                    <!-- <p>
                                         <?php echo $item->ItemDescription; ?></p> -->
                                    <p>
                                        <?php echo $item->ItemLongDescription; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="product-action col-md-2">
                            <div class="pro-button-top col-md-12">
                                <a href="javascript:shoppingCartAddItem('<?php echo $itemName; ?>', $('#itemSingleQty').val());" onclick=" window.location = '#/?page=forms&action=shoppingcart';">add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <!-- left-sidebar start -->
<?php elseif(key_exists("items", $_GET)): ?>
    <?php
        $categories = $data->getCategories($_GET["family"]);
        $items = $data->getItems($_GET["category"]);
        //      echo json_encode($categories);
    ?>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <!-- widget-categories start -->
        <aside class="widget widget-categories">
            <h3 class="sidebar-title">Categories</h3>
            <ul class="sidebar-menu">
                <?php foreach($categories as $categoryName=>$category): ?>
                    <li <?php echo ($categoryName == $_GET["category"] ? "style=\"font-weight:600;\"" : ""); ?>><a href="<?php echo $linksMaker->makeCategoryLink($categoryName); ?>"><?php echo $categoryName; ?></a> <span class="count"><!-- (14)  --></span></li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </div>
    <!-- left-sidebar end -->
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
                        <select>
                            <option value="audi">Sort by Price: low to high</option>
                            <option value="audi">Sort by Price: high to low</option>
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
                            <?php //if($item->CartItem): ?>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="<?php echo $linksMaker->makeItemLink($itemName); ?>">
                                                <img class="primary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                                                <img class="secondary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action">
                                            <div class="pro-button-top">
                                                <a href="javascript:shoppingCartAddItem('<?php echo $itemName; ?>');">add to cart</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h3 style=" font-size:14pt; font-weight:600">
                                                <a href="<?php echo $linksMaker->makeItemLink($itemName); ?>"><?php echo $itemName; ?></a></h3>
                                            <div class="pro-price">
                                                <span class="normal"><?php echo formatCurrency($item->Price); ?></span>
                                            </div>
                                            <div class="product-desc" style=" font-size:12pt; font-weight:600">
                                                <p>
                                                    <?php echo $item->ItemDescription; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php //endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="row shop-list">
                        <!-- single-product start -->
                        <!-- single-product start -->
                        <?php foreach($items as $itemName=>$item): ?>
                            <?php //if($item->CartItem): ?>
                                <div class="col-md-12">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="<?php echo $linksMaker->makeItemLink($itemName); ?>">
                                                <img class="primary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                                                <img class="secondary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action">
                                            <div class="pro-button-top">
                                                <a href="javascript:shoppingCartAddItem('<?php echo $itemName; ?>');">add to cart</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h3>
                                                <a href="<?php echo $linksMaker->makeItemLink($itemName); ?>"><?php echo $itemName; ?></a></h3>
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
                            <?php //endif; ?>
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
<?php elseif(key_exists("categories", $_GET)): ?>
        <?php
            $categories = $data->getCategories($_GET["family"]);
            //echo json_encode($categories);
        ?>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <!-- widget-categories start -->
            <aside class="widget widget-categories">
                <h3 class="sidebar-title"><?php echo $translation->translateLabel("Families"); ?></h3>
                <ul class="sidebar-menu">
                    <?php foreach($families as $familyName=>$family): ?>
                        <li <?php echo ($familyName == $_GET["family"] ? "style=\"font-weight:600;\"" : ""); ?>><a href="<?php echo $linksMaker->makeFamilyLink($familyName); ?>"><?php echo $familyName; ?></a> <span class="count"><!-- (14) --></span></li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>
        <!-- left-sidebar end -->
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
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row">
                            <!-- single-product start -->
                            <?php foreach($categories as $categoryName=>$category): ?>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="<?php echo $linksMaker->makeCategoryLink($categoryName); ?>">
                                                <img class="primary-img" src="<?php echo $linksMaker->makeCategoryImageLink($category); ?>" alt="" />
                                                <img class="secondary-img" src="<?php echo $linksMaker->makeCategoryImageLink($category); ?>" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h3 style=" font-size:14pt; font-weight:600">
                                                <a href="<?php echo $linksMaker->makeCategoryLink($categoryName); ?>"><?php echo $categoryName; ?></a></h3>
                                            <div class="product-desc">
                                                <p style=" font-size:12pt; font-weight:600">
                                                    <?php echo $category->CategoryDescription; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="row shop-list">
                            <!-- single-product start -->
                            <!-- single-product start -->
                            <?php foreach($categories as $categoryName=>$category): ?>
                                <div class="col-md-12">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="<?php echo $linksMaker->makeCategoryLink($categoryName); ?>">
                                                <img class="primary-img" src="<?php echo $linksMaker->makeCategoryImageLink($category); ?>" alt="" />
                                                <img class="secondary-img" src="<?php echo $linksMaker->makeCategoryImageLink($category); ?>" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h3>
                                                <a href="<?php echo $linksMaker->makeCategoryLink($categoryName); ?>"><?php echo $categoryName; ?></a></h3>
                                            <div class="product-desc">
                                                <p>
                                                    <?php echo $category->CategoryDescription; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php else: ?>
        <!-- shop-content start -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="shop-content">
                <!-- Nav tabs -->
                <ul class="shop-tab" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab"
                            data-toggle="tab"><i class="fa fa-th"></i></a>
                    </li>
                    <li role="presentation">
                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                            <i class="fa fa-list"></i></a>
                    </li>
                </ul>
                <!-- <div class="show-result">
                     <p>
                     Showing 1&ndash;12 of 19 results</p>
                     </div> -->
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row">
                            <!-- single-product start -->
                            <?php echo "" //"<pre>" . json_encode($families, JSON_PRETTY_PRINT) . "</pre>"; ?>
                            <?php foreach($families as $familyName=>$family): ?>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="<?php echo $linksMaker->makeFamilyLink($familyName); ?>">
                                                <img class="primary-img" src="<?php echo $linksMaker->makeFamilyImageLink($family); ?>" alt="" />
                                                <img class="secondary-img" src="<?php echo $linksMaker->makeFamilyImageLink($family); ?>" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h3>
                                                <a href="<?php echo $linksMaker->makeFamilyLink($familyName); ?>" style=" font-size:14pt; font-weight:600"><?php echo $family->FamilyName; ?></a></h3>
                                            <div class="product-desc">
                                                <p style=" font-size:12pt; font-weight:600">
                                                    <?php echo $family->FamilyDescription; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="row shop-list">
                            <!-- single-product start -->
                            <div class="col-md-12">
                                <?php foreach($families as $familyName=>$family): ?>
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="<?php echo $linksMaker->makeFamilyLink($familyName); ?>">
                                                <img class="primary-img" src="<?php echo $linksMaker->makeFamilyImageLink($family); ?>" alt="" />
                                                <img class="secondary-img" src="<?php echo $linksMaker->makeFamilyImageLink($family); ?>" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h3>
                                                <a href="<?php echo $linksMaker->makeFamilyLink($familyName); ?>"><?php echo $familyName; ?></a></h3>
                                            <div class="product-desc">
                                                <p>
                                                    <?php echo $family->FamilyDescription; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
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
    </div>
<?php endif; ?>

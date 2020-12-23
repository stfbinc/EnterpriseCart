<!-- header-bottom-area end -->
<!-- main-menu-area start -->
<div class="main-menu-area hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="main-menu">
                    <nav>
                        <ul id="desktopMenu">
                            <!--                             <li><a href="#/?page=index&action=store" about"><?php echo $translation->translateLabel("Store"); ?></a></li> -->
                            
                            <li><a href="#/?page=forms&action=products"><?php echo $translation->translateLabel("Products"); ?></a>
                                <?php if($scope["config"]["software"] == "Cart"): ?>
                                    <ul id="productsFamilies">
                                    </ul>
                                <?php endif; ?>
                            </li>
                            <!-- <li><a href="#/?page=forms&action=search"><?php echo $translation->translateLabel("Search"); ?></a>
                                 </li> -->
                            <li><a href="#/?page=forms&action=shoppingcart"><?php echo $translation->translateLabel("My Cart"); ?></a>
                            </li>

                            

                            <?php if($cartSettings->Support): ?>
                                <li><a href="#/?page=forms&action=helpdesk"><?php echo $translation->translateLabel("Support"); ?></a>

                                    <ul>
                                        <li><a href="#/?page=forms&action=helpdesk&pending=1"><?php echo $translation->translateLabel("Pending Tickets"); ?></a></li>
                                        <li><a href="#/?page=forms&action=helpdesk&closed=1"><?php echo $translation->translateLabel("Closed Tickets"); ?></a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if(key_exists("Customer", $user)): ?>
                                <!-- Navigation menu for Reports -->
                                <li><a href="#/?page=forms&action=report"><?php echo $translation->translateLabel("Reports"); ?></a>
                                    <ul>
                                        <li><a href="#/?page=forms&action=report&content=orders"><?php echo $translation->translateLabel("Orders"); ?></a></li>
                                        <li><a href="#/?page=forms&action=report&content=customerstatements"><?php echo $translation->translateLabel("Statements"); ?></a></li>
                                        <li><a href="#/?page=forms&action=report&content=invoices"><?php echo $translation->translateLabel("Invoices"); ?></a></li>
                                        <li><a href="#/?page=forms&action=report&content=quotes"><?php echo $translation->translateLabel("Quotes"); ?></a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>            
<!-- main-menu-area end -->
<!-- mobile-menu-area start -->
<div class="mobile-menu-area visible-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul id="mobileMenu">
                        </ul>
                    </nav>
                </div>     
            </div>
        </div>
    </div>
</div>
<!-- mobile-menu-area end -->   

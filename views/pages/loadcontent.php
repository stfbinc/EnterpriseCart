<div class="heading-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Pages</a></li>
		    <li><a href="#/?page=forms&action=loadcontent&content=<?php echo $_GET["content"];?>"><?php echo $_GET["content"];?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
    echo $data->getContent($_GET["content"]);
?>

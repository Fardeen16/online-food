<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <div class="filter">
            <button class=" button button1" onclick="window.location.href='<?php echo SITEURL; ?>foods-veg.php'">Veg</button>
            <button class=" button button2" onclick="window.location.href='<?php echo SITEURL; ?>foods-non-veg.php'">Non-Veg</button>
            <button class=" button button2" onclick="window.location.href='<?php echo SITEURL; ?>foods.php'">Both</button>
            </div>
            
            <?php 
                //Display Foods that are Active
                $sql = "SELECT * FROM tbl_food WHERE types='veg'";

                //Executing  Query
                $res=mysqli_query($conn, $sql);

                //Counting rows
                $count = mysqli_num_rows($res);

                //CHecking if the foods availalable or not
                if($count>0){
                    //if Available
                    while($row=mysqli_fetch_assoc($res)){
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //CHeck whether image available or not
                                    if($image_name==""){
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else{
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                            </div>
                            <form method="post" action="index.php?action=add&id=<?php echo $row['id']; ?>">
                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <input type="text" name="quantity" class="form-control" value="1" />
                                <input type="hidden" name="hidden_name" value="<?php echo $row["title"]; ?>" ?>
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" ?>
                                <br>


                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn" value="Add to Cart" />
                        
                            </div>
                            </form>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Food not Available
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>

            

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
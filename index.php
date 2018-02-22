<?php
    //calls db.php page
    require_once('./db.php');

    //Gets the category ID
    //on fresh page load shows items in category_id 1
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if($category_id == NULL || $category_id ==FALSE){
        $category_id = 1;
    }
    //Gets the name of the selected category
    $queryCategory = 'SELECT * FROM categories WHERE categoryID = "category_id';
    $statement1 = $db->prepare($queryCategory);
    $statement1 -> bindValue(':catefory_id', $category_id);
    $statement1 -> execute();
    $category = $statement1->fetch();
    $category_name = $category['categoryName'];
    $statement1 -> closeCursor();

    //Gets all the categories
    $queryAllCategories = 'SELECT * FROM categories  ORDER BY categoryID';
    $statement2 = $db->prepare($queryAllCategories);
    $statement2->execute();
    $categories = $statement2->fetchAll();
    $statement2->closeCursor();

    //Gets the products for the selected category
    $queryProducts = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productID';
    $statement3 = $db->prepare($queryProducts);
    $statement3->bindValue(':category_id', $category_id);
    $statement3->execute();
    $products = $statement3->fetchAll();
    $statement3->closeCursor();
?>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Product Directory</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class"col-sm-4">
                    <ul>
                        <?php foreach ($categories as $category) : ?>
                        <li>
                            <a href="?category_id=<?php echo $category['categoryID']; ?>">
                                <?php echo $category['categoryName']; ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class"col-sm-8">
                    <h2><?php echo $category_name; ?></h2>
                    <table>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th class="right">Price</th>
                        </tr>

                        <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?php echo $product['productCode']; ?></td>
                            <td><?php echo $product['productName']; ?></td>
                            <td class="right"><?php echo $product['listPrice']; ?></td>
                        </tr>
                        <?php endforeach; ?>            
                    </table>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
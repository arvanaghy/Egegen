<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>EGEGEN BackendTask</title>
</head>
<body>
<div class="container-fluid">
    <div class="row py-3">
        <div class="col-12 bg-light">
            <h1 class="text-center">
                Backend Task Ilyas Ramazanzadeh Arvanaghy.
            </h1>
        </div>
    </div>
    <div class="row my-3 justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Create New Product :
                </div>
                <div class="card-body">
                    <form action="<?= base_url();?>Home/product_submit" method="post" class="row justify-contents-center align-items-center">
                        <div class="col-md-4 my-1 form-group">
                            <? if ($products_list): ?>
                                <div class="card">
                                    <div class="card-header">
                                        Past Products Used for Creation:
                                    </div>
                                    <div class="card-body bg-light">
                                        <? foreach ($products_list as $products_value): ?>
                                            <div class="form-check">
                                                <input class="form-check-input" name="products[]" type="checkbox" value="<?= $products_value->id; ?>" id="p_chk_box_<?= $products_value->id; ?>">
                                                <label class="form-check-label" for="p_chk_box_<?= $products_value->id; ?>">
                                                    <?= $products_value->name; ?>
                                                </label>
                                            </div>
                                        <? endforeach;?>
                                    </div>
                                </div>
                            <? endif; ?>
                        </div>
                        <div class="col-12 my-1 form-group">
                            <label for="product_name" class="form-label">Insert Product Name:</label>
                            <input type="text" minlength="1" required name="product_name" id="product_name" class="form-control">
                        </div>
                        <div class="col-12 form-group my-1">
                            <div class="col-12 form-group text-end">
                                <input type="submit" class="btn btn-success" value="Submit Product" name="product_submit" id="product_submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Our Products Lists:
                </div>
                <div class="card-body">
                    <?
                    function printNamesWithParents($namesWithParents) {
                        echo '<ul>';
                        echo '<li>' . $namesWithParents[0] . '</li>';
                        if (!empty($namesWithParents[1])) {
                            foreach ($namesWithParents[1] as $parent) {
                                echo '<li>';
                                printNamesWithParents($parent);
                                echo '</li>';
                            }
                        }
                        echo '</ul>';
                    }
                    foreach ($products_parent_view as $products_parent){
                        printNamesWithParents($products_parent);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
    </script>

    <script src="asset/navbar.js"></script>
</head>

<body>

<?php 
require_once __DIR__ . '/CategoryTree.php';
$categoryTree = new CategoryTree();
$categoryResult = $categoryTree->getCategoryResult()
?>

    <div class="container">
        
            
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                   
                    
                </ul>
                
            </div>
        </nav>
        
    </div>

</body>

</html>
<?php

class CategoryTree
{

    private $connection;

    function __construct(){
        $this->connection = mysqli_connect('localhost', 'root', '', 'database');
    }


    public function getCategoryTreeHTML($category, $parent = 0)
    {
        $html = "";
        if (isset($category['parentId'][$parent])) {
            $html .= "<ul class='dropdown-menu'>";
            foreach ($category['parentId'][$parent] as $cat_id) {
                if (!isset($category['parentId'][$cat_id])) {
                    $child = "";
                    if ($category['categoryResult'][$cat_id]['parent'] != 0) {
                        $child = "no-child";
                    }
                    $html .= "<li class = '$child " . "parent-" .
                    $category['categoryResult'][$cat_id]['parent'] .
                    "'><a href='#'>" . $category['categoryResult'][$cat_id]['category_name'] . 
                    "</a></li>";
                }
                if (isset($category['parentId'][$cat_id])) {
                    $parentDepth0 = "parent-depth-all";
                    if ($category['categoryResult'][$cat_id]['parent'] == 0) {
                        $parentDepth0 = "parent-depth-0";
                    }
                    $html .= "<li class= '$parentDepth0 " . 'parent-' .
                    $category['categoryResult'][$cat_id]['parent'] .
                    "'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>" . 
                    $category['categoryResult'][$cat_id]['category_name'] . " <b class='caret caret-right'></b></a>";

                    $html .= $this->getCategoryTreeHTML($category, $cat_id);
                    $html .= "</li>";
                }
            }
            $html .= "</ul>";
        }
        return $html;
    }



    public function getCategoryResult()
    {
        $query = "SELECT * FROM category ORDER BY parent, sort_order";
        $result = mysqli_query($this->connection, $query);

        $category = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $category['categoryResult'][$row['id']] = $row;
            $category['parentId'][$row['parent']][] = $row['id'];
        }

        return $category;
    }
}
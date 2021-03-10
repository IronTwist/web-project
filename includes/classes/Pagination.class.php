<?php

class Pagination
{   
    /**
     * Used to display post with pagination on home_place
     *
     */
    public function displayPostsWithPaginationHome($data, $elPerPage, $categoryFilter)
    {
        if (isset($categoryFilter) && $categoryFilter != "") {
            $data = categoryFilter($data, $categoryFilter);
        }
    
        if (!isset($_GET["page"])) {
            $_GET["page"] = 1;
        }
        
        $numarElemente = count($data);
        $_SESSION["totalNumberOfPosts"] = $numarElemente;
        $pagini = 0;
        $elementPerPage = $elPerPage;
        $currentPage = $_GET["page"];  //pag 1
        $nextPage = 0;
    
        $pagini = numaraPagini($numarElemente, $elementPerPage);
    
        if (isset($_GET["page"])) {
            $nextPage = $_GET["page"] + 1;
        }
    
        if (isset($_GET["page"])) {
            $previousPage = $_GET["page"] - 1;
        }
    
        for ($p = 1; $p <= $pagini; $p++) {
            if ($currentPage == $p) {
                $startAfisare = ($p-1) * $elementPerPage;
                $endAfisare =$startAfisare + $elementPerPage;
               
                while ($startAfisare < $endAfisare) {
                    if (isset($data[$startAfisare])) {
                        $post = $data[$startAfisare];
                        $postDateTime = $post["data"];
    
                        echo "<div class=\"postDisplay\">";
                        echo "<h3>"."&emsp;<a class=\"titlePost\" href=\"post.php?viewPost=".$post["id"]."\">".$post["title"]."</a></h3>";
                        echo "<hr>";
                        
                        echo '<p class="showContent">'.$post['content'].'</p>';
                        echo "<hr>";
                        echo "Posted ".displayWithoutZeroDates(getHowMuchTimePassed($postDateTime))." ago</br>";
                        // echo "</br>";
                        echo "<hr>";
                        
                        echo "<div>Post by ".getUserData($post["id_user"], "username")."</div>";
                        echo "<div>Category: ".$post["category"]."</div>";
                       
                        echo "</div>";
                    }
    
                    $startAfisare += 1;
                }
            }
        }
        echo "</br>"; ?>
            <div style="width: 100%; text-align: center;"><?php echo $currentPage." / ".$pagini ?></div>
            <?php
        echo "</br>";
        echo "<div class=\"paginationNavBar\">";
        $firstPage = 1;
    
        if ($currentPage == $pagini && $elementPerPage < $numarElemente) {
            echo "<a href=\"home_place.php?filter=".$categoryFilter."&page=".$firstPage."\">first-Page</a>  |  ";
        }
    
        if ($currentPage > 1) {
            echo "<a href=\"home_place.php?filter=".$categoryFilter."&page=".$previousPage."\">previous-Page</a>";
            echo " | ";
        }
            
        if ($currentPage < $pagini) {
            echo "<a href=\"home_place.php?filter=".$categoryFilter."&page=".$nextPage."\">next-Page</a>";
        }
    
        if ($currentPage != $pagini) {
            echo " | <a href=\"home_place.php?filter=".$categoryFilter."&page=".$pagini."\">last-page</a>";
        }
        echo "</div>";
    }
    //display public posts with pagination
    function displayPublicPostsWithPagination($data, $elPerPage){
        if (!isset($_GET["page"])) {
            $_GET["page"] = 1;
        }
    
        $numarElemente = count($data);
        $_SESSION["totalNumberOfPosts"] = $numarElemente;
        $pagini = 0;
        $elementPerPage = $elPerPage;
        $currentPage = $_GET["page"];  //pag 1
        $nextPage = 0;

        $pagini = numaraPagini($numarElemente, $elementPerPage);

        if (isset($_GET["page"])) {
            $nextPage = $_GET["page"] + 1;
        }

        if (isset($_GET["page"])) {
            $previousPage = $_GET["page"] - 1;
        }

        for ($p = 1; $p <= $pagini; $p++) {
            if ($currentPage == $p) {
                $startAfisare = ($p-1) * $elementPerPage;
                $endAfisare =$startAfisare + $elementPerPage;
           
                while ($startAfisare < $endAfisare) {
                    if (isset($data[$startAfisare])) {
                        $post = $data[$startAfisare];
                        $postDateTime = $post["data"];

                        echo "<div class=\"postDisplay\">";
                        echo "<h3>"."&emsp;".$post["title"]."</h3>";
                        echo "<hr>";
                    
                        echo '<p class="showContent">'.$post['content'].'</p>';
                        echo "<hr>";
                        echo "Posted ".displayWithoutZeroDates(getHowMuchTimePassed($postDateTime))." ago</br>";
                        echo "<hr>";
                    
                        echo "<div>User: ".$post["userName"]."</div>";
                        echo "<div>Category: ".$post["category"]."</div>";
                    
                        echo "</div>";
                    }

                    $startAfisare += 1;
                }
            }
        }

        echo "</br>"; ?>
        <div style="width: 100%; text-align: center;"><?php echo $currentPage." / ".$pagini ?></div>
        <?php
        echo "</br>";
        echo "<div class=\"paginationNavBar\">";
        
        $firstPage = 1;

        if ($currentPage > 1) {
            echo "<a href=\"login.php?page=".$firstPage."\">firstPage</a>  |  ";
            // echo "<a href=\"login.php?page=1\">firstPage</a>  |  ";
        }

        if ($currentPage > 1) {
            echo "<a href=\"login.php?page=".$previousPage."\">previousPage</a>";
            echo " | ";
        }
        
        if ($currentPage < $pagini) {
            echo "<a href=\"login.php?page=".$nextPage."\">nextPage</a>";
        }
        if ($currentPage != $pagini) {
            echo " | <a href=\"login.php?&page=".$pagini."\">lastpage</a>";
        }
        echo "</div>";
    }

    //pagination for myplace posts
    public function displayPostsWithPagination($data, $elPerPage, $categoryFilter)
    {
        if (isset($categoryFilter) && $categoryFilter != "") {
            $data = categoryFilter($data, $categoryFilter);
        }

        if (!isset($_GET["page"])) {
            $_GET["page"] = 1;
        }
    
        $numarElemente = count($data);
        $_SESSION["totalNumberOfPosts"] = $numarElemente;
        $pagini = 0;
        $elementPerPage = $elPerPage;
        $currentPage = $_GET["page"];  //pag 1
        $nextPage = 0;

        $pagini = numaraPagini($numarElemente, $elementPerPage);

        if (isset($_GET["page"])) {
            $nextPage = $_GET["page"] + 1;
        }

        if (isset($_GET["page"])) {
            $previousPage = $_GET["page"] - 1;
        }

        for ($p = 1; $p <= $pagini; $p++) {
            if ($currentPage == $p) {
                $startAfisare = ($p-1) * $elementPerPage;
                $endAfisare =$startAfisare + $elementPerPage;
           
                while ($startAfisare < $endAfisare) {
                    if (isset($data[$startAfisare])) {
                        $post = $data[$startAfisare];
                        $postDateTime = $post["data"];

                        echo "<div class=\"postDisplay\">";
                        echo "<h3>"."&emsp;<a class=\"titlePost\" href=\"post.php?viewPost=".$post["id"]."\">".$post["title"]."</a></h3>";
                        echo "<hr>";
                    
                        echo '<p class="showContent">'.$post['content'].'</p>';
                        echo "<hr>";
                        echo "Posted ".displayWithoutZeroDates(getHowMuchTimePassed($postDateTime))." ago</br>";
                        // echo "</br>";
                        echo "<hr>";
                    
                        echo "<div>User: ".$_SESSION["user"]->getUserName()."</div>";
                        echo "<div>Category: ".$post["category"]."</div>";
                        echo "<a href=\"post.php?postId=".$post["id"]."\" id=\"btnEdit\" class=\"btnEdit\">Edit</a>";
                        echo "<a onclick=\"return confirm('Are you sure you want to delete this post?')\" 
                    href=\"myplace.php?clickDelete=".$post["id"]."\" id=\"btnDelete\" 
                    class=\"btnDelete\">&#x2715</a>";

                        echo "</div>";
                    }

                    $startAfisare += 1;
                }
            }
        }

        echo "</br>"; ?>
        <div style="width: 100%; text-align: center;"><?php echo $currentPage." / ".$pagini ?></div>
        <?php
        echo "</br>";
        echo "<div class=\"paginationNavBar\">";
        $firstPage = 1;

        if ($currentPage == $pagini) {
            echo "<a href=\"myplace.php?filter=".$categoryFilter."&page=".$firstPage."\">firstPage</a>  |  ";
        }

        if ($currentPage > 1) {
            echo "<a href=\"myplace.php?filter=".$categoryFilter."&page=".$previousPage."\">previousPage</a>";
            echo " | ";
        }
        
        if ($currentPage < $pagini) {
            echo "<a href=\"myplace.php?filter=".$categoryFilter."&page=".$nextPage."\">nextPage</a>";
        }
        if ($currentPage != $pagini) {
            echo " | <a href=\"myplace.php?filter=".$categoryFilter."&page=".$pagini."\">lastpage</a>";
        }
        echo "</div>";
    }

    public function searchPostsWithPagination($data, $elPerPage, $categoryFilter, $stringSearch){
        if (isset($categoryFilter) && $categoryFilter != "") {
            $data = categoryFilter($data, $categoryFilter);
        }

        if (!isset($_GET["page"])) {
            $_GET["page"] = 1;
        }
    
        $numarElemente = count($data);
        $_SESSION["totalNumberOfPosts"] = $numarElemente;
        $pagini = 0;
        $elementPerPage = $elPerPage;
        $currentPage = $_GET["page"];  //pag 1
        $nextPage = 0;

        $pagini = numaraPagini($numarElemente, $elementPerPage);

        if (isset($_GET["page"])) {
            $nextPage = $_GET["page"] + 1;
        }

        if (isset($_GET["page"])) {
            $previousPage = $_GET["page"] - 1;
        }

        for ($p = 1; $p <= $pagini; $p++) {
            if ($currentPage == $p) {
                $startAfisare = ($p-1) * $elementPerPage;
                $endAfisare =$startAfisare + $elementPerPage;
           
                echo $numarElemente." posts found for: ".$stringSearch; 

                while ($startAfisare < $endAfisare) {
                    if (isset($data[$startAfisare])) {
                        $post = $data[$startAfisare];
                        $postDateTime = $post["data"];

                        echo "<div class=\"postDisplay\">";
                        echo "<h3>"."&emsp;<a class=\"titlePost\" href=\"post.php?viewPost=".$post["id"]."\">".$post["title"]."</a></h3>";
                        echo "<hr>";
                    
                        echo '<p class="showContent">'.$post['content'].'</p>';
                        echo "<hr>";
                        echo "Posted ".displayWithoutZeroDates(getHowMuchTimePassed($postDateTime))." ago</br>";
                        // echo "</br>";
                        echo "<hr>";
                    
                        echo "<div>Post by ".getUserData($post["id_user"], "username")."</div>";
                        echo "<div>Category: ".$post["category"]."</div>";
                       
                        echo "</div>";
                    }

                    $startAfisare += 1;
                }
            }
        }

        echo "</br>"; ?>
        <div style="width: 100%; text-align: center;"><?php echo $currentPage." / ".$pagini ?></div>
        <?php
        echo "</br>";
        echo "<div class=\"paginationNavBar\">";
        $firstPage = 1;

        if ($currentPage == $pagini) {
            echo "<a href=\"search.php?stringToSearch=".$stringSearch."&filter=".$categoryFilter."&page=".$firstPage."\">firstPage</a>  |  ";
        }

        if ($currentPage > 1) {
            echo "<a href=\"search.php?stringToSearch=".$stringSearch."&filter=".$categoryFilter."&page=".$previousPage."\">previousPage</a>";
            echo " | ";
        }
        
        if ($currentPage < $pagini) {
            echo "<a href=\"search.php?stringToSearch=".$stringSearch."&filter=".$categoryFilter."&page=".$nextPage."\">nextPage</a>";
        }
        if ($currentPage != $pagini) {
            echo " | <a href=\"search.php?stringToSearch=".$stringSearch."&filter=".$categoryFilter."&page=".$pagini."\">lastpage</a>";
        }
        echo "</div>";
    }
}

?>
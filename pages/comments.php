<?php
    use scripts\Database;
    use scripts\class\FeedBack;

    $link = Database::getLink();
    $curComments = new FeedBack();
    
    $comments = $curComments->viewAllComments($link);
    
    $itemPerPage = 12;
    $totalItems = count($comments);
    $totalPages = ceil($totalItems / $itemPerPage);
    
    $number = isset($_GET['number']) ? (int)$_GET['number'] : 1;
    
    $startIndex = ($number - 1) * $itemPerPage;
    $endIndex = min($startIndex + $itemPerPage, $totalItems);
?>

<section class="comment-page">
	<h2 class="header-label">Last comments</h2>
	<div class="comments-block">
    	<?php  for ($i = $startIndex; $i < $endIndex; $i++) { ?>
    		<div class="comments">
    			<h5><?=$comments[$i]['user_name']?></h5>
    			<span class="date"><?=$comments[$i]['date']?></span>
    			<span class="comment"><?=$comments[$i]['comment']?></span>
    			<a href="index.php?page=movieDetail&id=<?=$comments[$i]['id_movie']?>"><?=$comments[$i]['movie_name']?></a>			
    		</div>
    	<?php }?>
    </div>
    
    <div class="pagination">
        <?php
            for ($i = 1; $i <= $totalPages; $i++){
           	    echo "<a href='?page=comments&number=$i'>$i</a> ";
            }
        ?>
    </div>
</section>


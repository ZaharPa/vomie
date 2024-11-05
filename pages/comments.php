<?php
    use scripts\Database;
    use scripts\class\FeedBack;

    $link = Database::getLink();
    $curComments = new FeedBack();
    
    $comments = $curComments->viewAllComments($link);
    
    $itemPerPage = 24;
    $totalItems = count($comments);
    $totalPages = ceil($totalItems / $itemPerPage);
    
    $number = isset($_GET['number']) ? (int)$_GET['number'] : 1;
    
    $startIndex = ($number - 1) * $itemPerPage;
    $endIndex = min($startIndex + $itemPerPage, $totalItems);
?>

<section class="comment-page">
	<div class="comments">
		<?php  for ($i = $startIndex; $i < $endIndex; $i++) { ?>
			<h5><?=$comments[$i]['user_name']?></h5>
			<span><?=$comments[$i]['date']?></span>
			<span><?=$comments[$i]['comment']?></span>
			<span><?=$comments[$i]['movie_name']?></span>			
		<?php }?>
	</div>
	<div class="pagination">
     	<?php
            for ($i = 1; $i <= $totalPages; $i++){
       	        echo "<a href='?page=home&number=$i'>$i</a> ";
            }
        ?>
    </div>
</section>
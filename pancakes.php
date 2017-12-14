<?php
	include('top.php');
	$xml=simplexml_load_file("recipes.xml") or die("Error: Cannot create object");
	
	$query = $xml->xpath('/cookbook/recipe[title="Pancakes"]');
	$data = $query[0];
	
	$ingredients = $data->ingredient;
	$recipetext = $data->recipetext;
	$imagepath = $data->imagepath;
	$nutrition = $data->nutrition;

?>	
<script type="text/javascript" src="jquery.js">
<script type="text/javascript">
function post()
{
  var comment = document.getElementById("comment").value;
  var name = document.getElementById("username").value;
  if(comment && name)
  {
    $.ajax
    ({
      type: 'post',
      url: 'post_comment.php',
      data: 
      {
         user_comm:comment,
	     user_name:name
      },
      success: function (response) 
      {
	    document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
	    document.getElementById("comment").value="";
        document.getElementById("username").value="";
  
      }
    });
  }
  
  return false;
}
</script>

<h1>Pancakes</h1>
<img src="<?php echo (string) $imagepath ?>" id="recipe" align="middle" alt="">
<h2>Ingredients</h2>
<ul class="list">
	<?php 
		foreach($ingredients->children() as $ingredient) {
			echo "<li>" . $ingredient . "</li>";
		}
	?>
</ul>
		
<h2>Directions</h2>
<ol id="directions">
	<?php
		foreach($recipetext->children() as $direction) {
			echo "<li>" . $direction . "</li>";
		}
	?>
</ol>
		
<h2>Nutrition Facts (Pancakes)</h2>
	<?php
		echo (string) $nutrition;
	?>
		
<div id="comments">

  <form method='post' action="" onsubmit="return post();">
  <textarea id="comment" placeholder="Write Your Comment Here....."></textarea>
  <br>
  <input type="text" id="username" placeholder="Your Name">
  <br>
  <input type="submit" value="Post Comment">
  </form>

  <div id="all_comments">
  <?php
    $host="localhost";
    $username="root";
    $password="";
    $databasename="Tasty";

    $connect=mysql_connect($host,$username,$password);
    $db=mysql_select_db($databasename);
  
    $comm = mysql_query("select name,comment,post_time from comments order by post_time desc");
    while($row=mysql_fetch_array($comm))
    {
	  $name=$row['name'];
	  $comment=$row['comment'];
      $time=$row['post_time'];
    ?>
	
	<div class="comment_div"> 
	  <p class="name">Posted By:<?php echo $name;?></p>
      <p class="comment"><?php echo $comment;?></p>	
	  <p class="time"><?php echo $time;?></p>
	</div>
  
    <?php
    }
    ?></div>
  

<?php

	include('bot.php');
?>
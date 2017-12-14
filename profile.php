<?php
	include('top.php');

	if (isset($_SESSION["username"])) {
		echo '<h1>' . $_SESSION["username"] . '\'s profile</h1>';
		echo '<div id="favImage">
		</div>';
		
	} else {
		echo "<h1>Please login to view profile</h1>";
	}
?>

<script id="source" language="javascript" type="text/javascript">
  $(function () {
    $.ajax({                                      
      url: 'profileparser.php',         
      data: "",
      dataType: 'text',                 
      success: function(data)          
      {
        var favorite = data;
        $('#favImage').html('<a href="'+favorite+'.php"><img src="'+favorite+'.png" class="image" alt=""></a>'); //Set output element html
	  } 
    });
  }); 
</script>
	
<?php	
	include('bot.php');
?>
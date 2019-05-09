<?php
    session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<!--
    by: Lucas W Gomez
    last modified: 5-9-2019

    you can run this using the URL: 
	lucaswgomez.github.io/sessions.php

-->

<head>
    <title>Sessions!</title>
    <meta charset="utf-8" />
	<?php
		require_once(login.php);
		require_once(get_postboard.php);	
		require_once(new_post_form);
	?>
    <link href="http://nrs-projects.humboldt.edu/~st10/styles/normalize.css"
          type="text/css" rel="stylesheet" />
</head>

<body>
<?php
	if (!array_key_exists("next_state", $_SESSION))
    {
		login();
		$_SESSION["next_state"] = "postboard";
    }
	elseif(($_SESSION["next_state"] == "postboard")
	    OR (array_key_exists("back", $_POST)))
    {
		get_postboard();
		$_SESSION["next_state"] = "newPost";
	}
	elseif($_SESSION["next_state"] == "newPost")
    {
	newPostForm();
	$_SESSION["next_state"] = "back";
    }
	elseif($_SESSION["next_state"] == "done")
    {
    ?>
       <p> Logging out... </p>
    <?php
        session_destroy();
		header("refresh: 2.5; https://lucaswgomez.github.io");
		exit;
   	}
    ?>

    <p>
        <a href=
           "http://jigsaw.w3.org/css-validator/check/referer?profile=css3">
            <img src="http://jigsaw.w3.org/css-validator/images/vcss"
                 alt="Valid CSS3!" height="31" width="88" />
        </a>
    </p>

</body>
</html>


<?php
function newPostForm()
{
	//No Login info
	if (( (! array_key_exists("username", $_POST)) or
         (! array_key_exists("password", $_POST)) or
         ($_POST["username"] == "") or
         ($_POST["password"] == "") or
         (! isset($_POST["username"])) or
         (! isset($_POST["password"])) ) and 
	 (! array_key_exists("username", $_SESSION)))
    	{
?>
        <p> You are not currently logged in. Please sign in to continue!</p>

<?php
	session_destroy();
	header("refresh: 2.5; https://lucaswgomez.github.io");
	exit;
   	 }

	//We have login info
	elseif (! array_key_exists("username",$_SESSION))
	{
	
    	$username = strip_tags($_POST["username"]);    
   	    $password = $_POST["password"];    
   	    $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
	}
	$username = $_SESSION["username"];
	$password = $_SESSION["password"];

	//Open connection
	$conn = hsu_conn($username, $password);

	//TODO: Write query to insert into database and to get the options for the select event options

	//Create Form
	?>
	<form method="post" action="<?= htmlentities($_SERVER['PHP_SELF'], 
                                       ENT_QUOTES) ?>">
		<fieldset>
			<legend>New Post</legend>
			<div class="fieldset-form">
				<label class="heading" for="primhost_fld">Who is primarily hosting the event?: </label>
				<input type="text" name="host" id="primhost_fld" required="required" />

				<label class="heading" for="addhost_fld">Additional hosts?: </label>
				<input type="text" name="add_host" id="addhost_fld" />
				<label class="heading" for="location_fld">Where is the event?: </label>
				<input type="text" name="location" id="location_fld" required="required" />
				<label class="heading">When is the event?: </label>
				<input type="date" name="date" id="date" required="required" />
				<input type="time" name="time" id="time" required="required" />
				<label class="heading" for="event_fld">What is the event?: </label>
				<select name="event" id="event_fld">
					<option value="workshop"> A Workshop/Skillshop</option>
					<option value="tour"> A Campus Tour</option>
					<option value="club"> A Club/Greek Event</option>
					<option value="sport"> A Sports Event </option>
					<option value="group"> A Special Group Event </option>
					<option value="art"> An Art Event</option>
					<option value="community"> A Community Event</option>
					<option value="speaker"> A Guest Speaker</option>
				</select>
				<label class="heading" for="img_fld"> Event Image: </label>
				<input type="text" name="custom_img" id="img_fld" maxlength="250" />
			</div>
		</fieldset>
		<fieldset>
            <legend> Submit Post </legend>
            <div class="sub-button">
                <button class="button" id="post_butt" name="newpost" value="newpost"><span>Post! </span></button>
            </div>
        </fieldset>
    </form>
	<?php
	oci_free_statement($title_query);
	oci_close($conn);
}

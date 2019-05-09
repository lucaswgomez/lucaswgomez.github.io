<?php
function login()
{
	if(( (! array_key_exists("username", $_POST)) or
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

	else
	{
		$username = strip_tags($_POST["username"]);
		$password = $_POST["password"];
		$_SESSION["username"] = $username;

		$db_conn_str = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                    (HOST = cedar.humboldt.edu)
                                    (PORT = 1521))
                               (CONNECT_DATA = (SID = STUDENT)))";
		$conn = oci_connect($username, $password, $db_conn_str);
		if(! $conn)
		{
		?>
			<p>Could not log in to Oracle, please try again.</p>

			<?php
				require_once("328footer.html");
				exit;
		}
		$_SESSION["connection"] = $conn;
		?>
		<h1> Welcome <?php echo $_SESSION["username"]; ?>!<br />
<?php
	}
?>

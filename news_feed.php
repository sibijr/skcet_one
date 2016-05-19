<?php

require_once 'core/init.php';

		$uploadDir = 'profile_pics/';
		if(input::exists())
		{
		$fileName = $_FILES['Photo']['name'];
		$tmpName  = $_FILES['Photo']['tmp_name'];
		$fileSize = $_FILES['Photo']['size'];
		$fileType = $_FILES['Photo']['type'];

		$userfile_extn = substr($fileName, strrpos($fileName, '.')+1);
		$userfile_extn = '.' . $userfile_extn;
		$filePath = $uploadDir . $fileName;

		if(file_exists($filePath))
		 { 
		 	unlink ($filePath); 
		 }

		$result = move_uploaded_file($tmpName, $filePath);
		if (!$result) {
		echo "Error uploading file";
		exit;
		}                                           

		if(!get_magic_quotes_gpc())
		{
		    $fileName = addslashes($fileName);
			$filePath = addslashes($filePath);
		}
		$title = input::get('title');
		$desc = input::get('desc');
		$db = DB::getInstance();
		if($db->query("insert into news_feed (`title`,`desc`,`img`) value ('".$title."','".$desc."','".$filePath."')")){
		echo "query ok";

		}
		}

?>
<form name="Image" enctype="multipart/form-data" action="" method="POST">
Title : <input name="title" type="text" /><br><br>
Description : <textarea name="desc"></textarea><br><br>

Select image : <input type="file" name="Photo" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26">
<input type="submit" class="button" name="Submit" value="Submit"> 
</form>

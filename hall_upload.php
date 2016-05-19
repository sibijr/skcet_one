<?php
require_once 'core/init.php';
require_once 'includes/header.php';
if(session::exists('hall')){
	echo session::flash('hall');
}
?>
<div class="container-fluid margin-top">
<div class="row">
<div id="hall" class="col-md-offset-3 col-md-6 shadow-z-2">
<form action="hall_upload_process.php" method="post" enctype="multipart/form-data">
<legend>Hall Upload</legend>
<div class="form-group">
<label for="file" class="col-md-2 control-label ">File</label>
<div class="col-md-10">
<input type="file" id="file" class="form-control" name="fileToUpload"/>
</div>
</div>
<div class="col-md-4">
<input type="submit" value="Upload Image" name="submit" class="btn btn-primary btn-block" >
</div>
<div class="col-md-offset-4 col-md-4">
<a href="files/example.xls" download class="btn btn-primary btn-block">Download Sample </a>
</div>
</form>
</div>
</div>
</div>
<?php require_once 'includes/footer.php';?>
</body>
</html>

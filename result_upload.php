<?php
require_once('core/init.php');
require_once('includes/header.php');
?>

<?php
if(session::exists('result')){
	echo session::flash('result');
}
?>
<div class="container-fluid margin-top">
<div class="row">
<div id="result" class="col-md-6 col-md-offset-3 shadow-z-2" >
<form action="result_upload_process.php" method="post" enctype="multipart/form-data">
<legend>Result Upload</legend>
<div class="form-group">
<label for="file" class="control-label col-md-2">File</label>
<div class="col-md-10">
<input type="file" class="form-control col-md-10" name="fileToUpload" id="fileToUpload">
</div>
</div>
<div class="col-md-4">
<input type="submit" value="Upload" name="submit" class="btn btn-primary btn-block" >
</div>
<div class="col-md-offset-4 col-md-4">
<a href="files/example.xls" class="btn btn-primary btn-block "download>Download Sample</a>
</div>
</form>
</div>
</div>
</div>
<?php require_once 'includes/footer.php';?>
</body>
</html>
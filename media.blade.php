<?php
use App\Http\Controllers\AdminController;
?>
@component('admin_parts/header')
@endcomponent
<!-- Page Body Start-->
<div class="page-body-wrapper">
	<!-- Page Sidebar Start-->
	@component('admin_parts/sidebar')
	@endcomponent
	<div class="page-body">
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col">
						<div class="page-header-left">
							<h3> Media </h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="row">
				<!-- Base styles-->
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<h4 style="color:lightgreen"> {{ session('success') }} </h4>
								<form action="" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-4">
											@csrf
											<input type="file" accept=".png,.jpg,.jpeg,.PNG,.JPG,.JPEG,.gif,.Gif,.pdf,.PDF" name="title[]" multiple required class="form-control">
										</div>
										<div class="col-md-4">
											<input type="submit" class="btn btn-primary" value="Upload Attachments">
										</div>
									</div>
								</form>
								<div class="row" style="padding-top:50px">
									<?php
									$folder = "files/documents";
									chdir($folder);
									if (isset($_GET['del'])) {
										try {
											if (unlink($_GET['del'])) {
												echo "<script>alert('Attachment file deleted ');location.href='./media'</script>";
											} else {
												echo "<script>alert('Attachment file can not delete ');location.href='./media'</script>";
											}
										} catch (Exception  $e) {
										}
									}
									$dir = scandir('./');
									foreach ($dir as $fol) {
										if (strlen($fol) < 3) {
										} else {
									?>
											<div class='col-md-3' style='margin-bottom:10px'>
												<div class="imgBox" style='max-width:100%; height:150px'>
													<?php
													if (strpos($fol, '.png') || strpos($fol, '.jpg') || strpos($fol, '.jpeg') || strpos($fol, '.gif') || strpos($fol, '.PNG') || strpos($fol, '.JPG') || strpos($fol, '.JPEG') || strpos($fol, '.GIF')) {
													?>
														<img src='/files/documents/{{ $fol }}' style="height:150px;width:100%">
													<?php } else { ?>
														<img src='/file.png' style="height:150px;width:100%">
													<?php } ?>
												</div>
												<div class="overlyBtn" style="margin-top:-60px; position:absolute; width:100%; display:inline-block">
													<a href="/files/documents/{{ $fol }}" target="_blank" class="btn btn-primary float-left"> <i class="fa fa-eye"></i> </a>
													<a href="?del={{ $fol }}" class="btn btn-danger float-right" onclick="return confirm('This attachment will delete from server also.')"> <i class="fa fa-trash"></i> </a>
												</div>
											</div>
									<?php
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
	</div>
	<style>
		.float-right {
			margin-right: 50px;
		}
		.float-left {
			margin-left: 20px
		}
	</style>
	@component('admin_parts/footer')
	@endcomponent
	</body>
	</html>

<?php  if (isset($_GET['src'])) { $pt=array( '0'=>'../xc_uploads/thumbs/0/', '1'=>'../xc_uploads/thumbs/1/', '2'=>'../xc_uploads/thumbs/2/' ); $fil=$pt[$_GET['src']].$_GET['thumb']; $mime=file_type($fil); header("Content-Type: $mime"); if (is_file($fil)) { readfile($fil); die(); } } function file_type($file) { $exif = exif_read_data($file, 0, true); $ret = $exif['FILE']; return image_type_to_mime_type($ret['FileType']); } ?>
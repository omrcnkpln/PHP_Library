<form action = "gonder.php" method = "post" enctype = "multipart/form-data">
	<table cellpadding = "5" cellspacing = "5">
		
		<tr>
			<td>FTP Sunucusu : </td>
			<td><input type = "text" name = "ftp_sunucu" /></td>
		</tr>
		
		<tr>
			<td>FTP Kullanýcý Adý : </td>
			<td><input type = "text" name = "ftp_kadi" /></td>
		</tr>
		
		<tr>
			<td>FTP Sifre : </td>
			<td><input type = "password" name = "sifre" /></td>
		</tr>
		
		<tr>
			<td>FTP Dosya Yolu : </td>
			<td><input type = "text" name = "ftp_dyolu" /></td>
		</tr>
		
		<tr>
			<td>Dosya Secin : </td>
			<td><input type = "file" name = "dosya" /></td>
		</tr>
		
		<tr>
			<td></td>
			<td><input type = "submit" value = "FTPye Yükle" /></td>
		</tr>
		
	</table>
</form>
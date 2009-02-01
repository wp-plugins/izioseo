<div class="wrap">
	<div class="icon32" style="background: url('<?php echo $this->images ?>/izioseo-dashboard.png') no-repeat;"><br /></div>
	<h2><?php _e('izioSEO Wordpress SEO Plugin › Keywords', 'izioseo') ?></h2>
	<?php if (isset($message)) : ?>
		<?php if ($message == 'success merge') : ?>
			<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204);">
				<p><?php _e('Die Einstellungen f&uuml;r izioSEO wurden gespeichert.', 'izioseo') ?></p>
			</div>
		<?php else : ?>
			<div class="error below-h2">
				<p><strong><?php _e('Error') ?></strong>: <?php _e('Es trat ein Fehler beim Erstellen der Stopwordliste auf.', 'izioseo') ?></p>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<form method="post">
		<p><?php _e('Bearbeiten Sie die Stopword-Liste und die Liste mit den Keywords und Akronymen. Dadurch k&ouml;nnen Sie geziehlt steuern, welche W&ouml;rter f&uuml;r die Generierung von META-Daten verwendet werden sollen.', 'izioseo'); ?></p>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php echo $this->helpButton('Keywords sammeln') ?> <label for="izioseo_collect_keywords"><?php _e('Keywords sammeln', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="keywords[izioseo_collect_keywords]" id="izioseo_collect_keywords" onclick="javascript:disableTextareas();"<?php if ($data['izioseo_collect_keywords'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Sollen die Keywords in der "keywords.txt" Datei gesammelt werden, wenn die Generierung der META-Keywords und META-Description f&uuml;r die jeweilige Unterseite aktiviert ist. Dadurch k&ouml;nnen Sie auf einfache Weise ihre Stopword-Liste individuell erweitern.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Stopword Liste') ?> <label for="izioseo_file_stopwords"><?php _e('Stopword Liste', 'izioseo') ?></label></th>
					<td><textarea name="keywords[izioseo_file_stopwords]" id="izioseo_file_stopwords" style="width: 450px; height: 150px;"><?php if (isset($data['izioseo_file_stopwords'])) : ?><?php echo $data['izioseo_file_stopwords'] ?><?php endif; ?></textarea></td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Keyword Liste') ?> <label for="izioseo_file_keywords"><?php _e('Keyword Liste', 'izioseo') ?></label></th>
					<td><textarea name="keywords[izioseo_file_keywords]" id="izioseo_file_keywords" style="width: 450px; height: 150px;"><?php if (isset($data['izioseo_file_keywords'])) : ?><?php echo $data['izioseo_file_keywords'] ?><?php endif; ?></textarea></td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Acronym Liste') ?> <label for="izioseo_file_acronyms"><?php _e('Acronyme', 'izioseo') ?></label></th>
					<td><textarea name="keywords[izioseo_file_acronyms]" id="izioseo_file_acronyms" style="width: 450px; height: 150px;"><?php if (isset($data['izioseo_file_acronyms'])) : ?><?php echo $data['izioseo_file_acronyms'] ?><?php endif; ?></textarea></td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Einstellungen speichern', 'izioseo')?>" />
		</p>
	</form>
</div>

<script type="text/javascript">
<!--

	disableTextareas();
	function disableTextareas()
	{
		if (document.getElementById('izioseo_collect_keywords').checked == true)
		{
			document.getElementById('izioseo_file_stopwords').disabled = false;
			document.getElementById('izioseo_file_keywords').disabled = false;
			document.getElementById('izioseo_file_acronyms').disabled = false;
		}
		else
		{
			document.getElementById('izioseo_file_stopwords').disabled = true;
			document.getElementById('izioseo_file_keywords').disabled = true;
			document.getElementById('izioseo_file_acronyms').disabled = true;
		}
	}

//-->
</script>
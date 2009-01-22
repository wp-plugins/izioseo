<div class="wrap">
	<div class="icon32" style="background: url('<?= $this->images ?>/izioseo-dashboard.png') no-repeat;"><br /></div>
	<h2><? _e('izioSEO Wordpress SEO Plugin › Keywords', 'izioseo') ?></h2>
	<? if (isset($message)) : ?>
		<? if ($message == 'success merge') : ?>
			<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204);">
				<p><? _e('Die Einstellungen f&uuml;r izioSEO wurden gespeichert.', 'izioseo') ?></p>
			</div>
		<? else : ?>
			<div class="error below-h2">
				<p><strong><? _e('Error') ?></strong>: <? _e('Es trat ein Fehler beim Erstellen der Stopwordliste auf.', 'izioseo') ?></p>
			</div>
		<? endif; ?>
	<? endif; ?>
	<form method="post">
		<p><? _e('Bearbeiten Sie die Stopword-Liste und die Liste mit den Keywords und Akronymen. Dadurch k&ouml;nnen Sie geziehlt steuern, welche W&ouml;rter f&uuml;r die Generierung von META-Daten verwendet werden sollen.', 'izioseo'); ?></p>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?= $this->helpButton('Keywords sammeln') ?> <label for="izioseo_collect_keywords"><? _e('Keywords sammeln', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="keywords[izioseo_collect_keywords]" id="izioseo_collect_keywords" onclick="javascript:disableTextareas();"<? if ($data['izioseo_collect_keywords'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Sollen die Keywords in der "keywords.txt" Datei gesammelt werden, wenn die Generierung der META-Keywords und META-Description f&uuml;r die jeweilige Unterseite aktiviert ist. Dadurch k&ouml;nnen Sie auf einfache Weise ihre Stopword-Liste individuell erweitern.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Stopword Liste') ?> <label for="izioseo_file_stopwords"><? _e('Stopword Liste', 'izioseo') ?></label></th>
					<td><textarea name="keywords[izioseo_file_stopwords]" id="izioseo_file_stopwords" style="width: 450px; height: 150px;"><? if (isset($data['izioseo_file_stopwords'])) : ?><?= $data['izioseo_file_stopwords'] ?><? endif; ?></textarea></td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Keyword Liste') ?> <label for="izioseo_file_keywords"><? _e('Keyword Liste', 'izioseo') ?></label></th>
					<td><textarea name="keywords[izioseo_file_keywords]" id="izioseo_file_keywords" style="width: 450px; height: 150px;"><? if (isset($data['izioseo_file_keywords'])) : ?><?= $data['izioseo_file_keywords'] ?><? endif; ?></textarea></td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Acronym Liste') ?> <label for="izioseo_file_acronyms"><? _e('Acronyme', 'izioseo') ?></label></th>
					<td><textarea name="keywords[izioseo_file_acronyms]" id="izioseo_file_acronyms" style="width: 450px; height: 150px;"><? if (isset($data['izioseo_file_acronyms'])) : ?><?= $data['izioseo_file_acronyms'] ?><? endif; ?></textarea></td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="<? _e('Einstellungen speichern', 'izioseo')?>" />
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
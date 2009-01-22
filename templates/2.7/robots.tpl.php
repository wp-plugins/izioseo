<div class="wrap">
	<div class="icon32" style="background: url('<?= $this->images ?>/izioseo-dashboard.png') no-repeat;"><br /></div>
	<h2><? _e('izioSEO Wordpress SEO Plugin › robots.txt', 'izioseo') ?></h2>
	<? if (isset($message)) : ?>
		<? if ($message == 'success robots') : ?>
			<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204);">
				<p><? _e('robots.txt wurde erfolgreich gespeichert.', 'izioseo') ?></p>
			</div>
		<? else : ?>
			<div class="error below-h2">
				<p><strong><? _e('Error') ?></strong>: <? _e('Es trat ein Fehler beim erstellen der robots.txt auf.', 'izioseo') ?></p>
			</div>
		<? endif; ?>
	<? endif; ?>
	<form method="post" action="">
		<p><? _e('&Uuml;ber das Textfeld ist es m&ouml;glich die robots.txt, welche im Root von Wordpress liegt, zu editieren und diverse Regeln f&uuml;r Suchmaschinenbots festzulegen. Mehr Informationen zum Aufbau einer robots.txt finden Sie in der Dokumentation von izioSEO oder unter: <a href="http://www.robotstxt.org" target="_blank">http://www.robotstxt.org/</a>', 'izioseo'); ?></p>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?= $this->helpButton('robots.txt') ?> <label for="file_robotstxt"><? _e('Inhalt robots.txt', 'izioseo') ?></label></th>
					<td><textarea name="robotstxt" id="file_robotstxt" rows="1" cols="1" style="width: 450px; height: 150px;"><?= $robotsTxt ?></textarea></td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="<? _e('robots.txt speichern', 'izioseo')?>" />
		</p>
	</form>
</div>

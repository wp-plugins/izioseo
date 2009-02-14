<div class="wrap">
	<?php if (isset($message)) : ?>
		<?php if ($message == 'success robots') : ?>
			<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204); margin-bottom:13px;">
				<p><?php _e('robots.txt wurde erfolgreich gespeichert.', 'izioseo') ?></p>
			</div>
		<?php else : ?>
			<div class="error below-h2" style="margin-bottom:13px;">
				<p><strong><?php _e('Error') ?></strong>: <?php _e('Es trat ein Fehler beim erstellen der robots.txt auf.', 'izioseo') ?></p>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<h2><?php _e('izioSEO Wordpress SEO Plugin › robots.txt', 'izioseo') ?></h2>
	<form method="post" action="">
		<p><?php _e('&Uuml;ber das Textfeld ist es m&ouml;glich die robots.txt, welche im Root von Wordpress liegt, zu editieren und diverse Regeln f&uuml;r Suchmaschinenbots festzulegen. Mehr Informationen zum Aufbau einer robots.txt finden Sie in der Dokumentation von izioSEO oder unter: <a href="http://www.robotstxt.org" target="_blank">http://www.robotstxt.org/</a>', 'izioseo'); ?></p>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php echo $this->helpButton('robots.txt') ?> <label for="file_robotstxt"><?php _e('Inhalt robots.txt', 'izioseo') ?></label></th>
					<td><textarea name="robotstxt" id="file_robotstxt" rows="1" cols="1" style="width: 450px; height: 150px;"><?php echo $robotsTxt ?></textarea></td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('robots.txt speichern', 'izioseo')?>" />
		</p>
	</form>
</div>

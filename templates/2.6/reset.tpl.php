<div class="wrap">
	<?php if (isset($message)) : ?>
		<?php if (substr($message, 0, 7) == 'success') : ?>
			<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204); margin-bottom:13px;">
				<p>
					<?php if ($message == 'success settings imported') : ?>
						<?php printf(__('Es wurden %s Einstellungen importiert.', 'izioseo'), $count) ?>
					<?php elseif ($message == 'success reset') : ?>
						<?php _e('Standardeinstellunge von izioSEO wurden geladen.', 'izioseo') ?>
					<?php endif; ?>
				</p>
			</div>
		<?php else : ?>
			<div class="error below-h2" style="margin-bottom:13px;">
				<p>
					<strong><?php _e('Error') ?></strong>:
					<?php if ($message == 'error no settings imported') : ?>
						<?php _e('Es wurden keine Einstellungen f&uuml;r izioSEO importiert.', 'izioseo') ?>
					<?php elseif ($message == 'error no import') : ?>
						<?php _e('Importieren nicht m&ouml;glich.', 'izioseo') ?>
					<?php elseif ($message == 'error no valid xml file') : ?>
						<?php _e('Die Datei ist keine valide XML-Datei.', 'izioseo') ?>
					<?php endif; ?>
				</p>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<h2><?php _e('izioSEO Wordpress SEO Plugin › Einstellungen zur&uuml;cksetzen', 'izioseo') ?></h2>
	<h3><?php echo $this->helpButton('Einstellungen exportieren') ?> <?php _e('Einstellungen exportieren', 'izioseo') ?></h3>
	<p><?php _e('Exportieren Sie ihre aktuellen Einstellungen von izioSEO. Nach dem Export k&ouml;nnen Sie jederzeit ihre aktuellen Einstellungen aus der gespeicherten XML-Datei wieder herstellen.', 'izioseo') ?></p>
	<p>
		<a class="button rbutton" href="<?php echo $_SERVER['REQUEST_URI'] ?><?php if (!isset($_GET['export'])) : ?>&amp;export<?php endif; ?>"><?php _e('Einstellungen exportieren', 'izioseo') ?></a>
		<?php if (get_option('__izioseo_reset_export', true)) : ?><span class="setting-description" style="font-size:10px;"><?php _e('Letztes Backup am ', 'izioseo') ?> <?php echo date('d.m.Y, \u\m H:i', get_option('__izioseo_reset_export', true)) ?></span><?php endif; ?>
	</p>
	<form method="post" action="" enctype="multipart/form-data">
		<h3 style="margin-top:40px;"><?php echo $this->helpButton('Einstellungen importieren') ?> <?php _e('Einstellungen importieren', 'izioseo') ?></h3>
		<p><?php echo _e('Importieren Sie bereits exportierte Einstellungen von izioSEO. Dazu ben&ouml;tigen Sie eine vorher exportierte XML-Datei mit den Einstellungen von izioSEO. <strong>Hinweis:</strong> Beim Importieren von Einstellungen gehen Ihre aktuellen Einstellungen verloren.', 'izioseo') ?></p>
		<p><?php _e('Datei w&auml;hlen:', 'izioseo') ?> <input id="upload" type="file" size="25" name="import" /></p>
		<p class="submit" style="border:0px; margin-top:0px; padding-top:0px;"><input class="button-primary" type="submit" value="<?php echo _e('Einstellungen importieren', 'izioseo') ?>" /></p>
	</form>
	<h3><?php echo $this->helpButton('Standardeinstellungen laden') ?> <?php _e('Standardeinstellungen laden', 'izioseo') ?></h3>
	<p><?php _e('Laden Sie die Standardeinstellungen von izioSEO und setzen Sie somit alle gespeicherten Einstellungen von izioSEO zur&uuml;ck. <strong>Hinweis:</strong> Durch den Aufruf dieser Funktion gehen alle bisher gespeicherten Einstellungen verloren.', 'izioseo') ?></p>
	<p style="margin-bottom:30px;"><a class="button rbutton" href="<?php echo $_SERVER['REQUEST_URI'] ?><?php if (!isset($_GET['reset'])) : ?>&amp;reset<?php endif; ?>"><?php _e('Standardeinstellungen laden', 'izioseo') ?></a></p>
</div>

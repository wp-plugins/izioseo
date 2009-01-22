<div class="wrap">
	<div class="icon32" style="background: url('<?= $this->images ?>/izioseo-dashboard.png') no-repeat;"><br /></div>
	<h2><? _e('izioSEO Wordpress SEO Plugin › Einstellungen zur&uuml;cksetzen', 'izioseo') ?></h2>
	<? if (isset($message)) : ?>
		<? if (substr($message, 0, 7) == 'success') : ?>
			<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204);">
				<p>
					<? if ($message == 'success settings imported') : ?>
						<?= str_replace('%count%', $count, __('Es wurden %count% Einstellungen importiert.', 'izioseo')) ?>
					<? elseif ($message == 'success reset') : ?>
						<? _e('Standardeinstellunge von izioSEO wurden geladen.', 'izioseo') ?>
					<? endif; ?>
				</p>
			</div>
		<? else : ?>
			<div class="error below-h2">
				<p>
					<strong><? _e('Error') ?></strong>:
					<? if ($message == 'error no settings imported') : ?>
						<? _e('Es wurden keine Einstellungen f&uuml;r izioSEO importiert.', 'izioseo') ?>
					<? elseif ($message == 'error no import') : ?>
						<? _e('Importieren nicht m&ouml;glich.', 'izioseo') ?>
					<? elseif ($message == 'error no valid xml file') : ?>
						<? _e('Die Datei ist keine valide XML-Datei.', 'izioseo') ?>
					<? endif; ?>
				</p>
			</div>
		<? endif; ?>
	<? endif; ?>
	<h3><?= $this->helpButton('Einstellungen exportieren') ?> <? _e('Einstellungen exportieren', 'izioseo') ?></h3>
	<p><? _e('Exportieren Sie ihre aktuellen Einstellungen von izioSEO. Nach dem Export k&ouml;nnen Sie jederzeit ihre aktuellen Einstellungen aus der gespeicherten XML-Datei wieder herstellen.', 'izioseo') ?></p>
	<p>
		<a class="button rbutton" href="<?= $_SERVER['REQUEST_URI'] ?><? if (!isset($_GET['export'])) : ?>&amp;export<? endif; ?>"><? _e('Einstellungen exportieren', 'izioseo') ?></a>
		<? if (get_option('__izioseo_reset_export', true)) : ?><span class="setting-description" style="font-size:10px;"><? _e('Letztes Backup am ', 'izioseo') ?> <?= date('d.m.Y, \u\m H:i', get_option('__izioseo_reset_export', true)) ?></span><? endif; ?>
	</p>
	<form method="post" action="" enctype="multipart/form-data">
		<h3 style="margin-top:40px;"><?= $this->helpButton('Einstellungen importieren') ?> <? _e('Einstellungen importieren', 'izioseo') ?></h3>
		<p><?= _e('Importieren Sie bereits exportierte Einstellungen von izioSEO. Dazu ben&ouml;tigen Sie eine vorher exportierte XML-Datei mit den Einstellungen von izioSEO. <strong>Hinweis:</strong> Beim Importieren von Einstellungen gehen Ihre aktuellen Einstellungen verloren.', 'izioseo') ?></p>
		<p><? _e('Datei w&auml;hlen:', 'izioseo') ?> <input id="upload" type="file" size="25" name="import" /></p>
		<p class="submit" style="margin-top:0px; padding-top:0px;"><input class="button-primary" type="submit" value="<?= _e('Einstellungen importieren', 'izioseo') ?>" /></p>
	</form>
	<h3><?= $this->helpButton('Standardeinstellungen laden') ?> <? _e('Standardeinstellungen laden', 'izioseo') ?></h3>
	<p><? _e('Laden Sie die Standardeinstellungen von izioSEO und setzen Sie somit alle gespeicherten Einstellungen von izioSEO zur&uuml;ck. <strong>Hinweis:</strong> Durch den Aufruf dieser Funktion gehen alle bisher gespeicherten Einstellungen verloren.', 'izioseo') ?></p>
	<p style="margin-bottom:30px;"><a class="button rbutton" href="<?= $_SERVER['REQUEST_URI'] ?><? if (!isset($_GET['reset'])) : ?>&amp;reset<? endif; ?>"><? _e('Standardeinstellungen laden', 'izioseo') ?></a></p>
</div>

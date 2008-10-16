<? if (isset($message)) : ?>
	<? if ($message == 'settings') : ?>
		<div id="message" class="updated fade">
			<p><? _e('Die Einstellungen f&uuml;r izioSEO wurden gespeichert.', 'izioseo') ?></p>
		</div>
	<? elseif ($message == 'merge') : ?>
		<div id="message" class="updated fade">
			<p><? _e('Die Stopword-Liste und alle dazuegh&ouml;rigen Dateien wurden verschmolzen und gespeichert.', 'izioseo') ?></p>
		</div>
	<? elseif ($message == 'robots') : ?>
		<div id="message" class="updated fade">
			<p><? _e('robots.txt wurde erfolgreich gespeichert.', 'izioseo') ?></p>
		</div>
	<? else : ?>
		<div id="notice" class="error fade">
			<p><? _e('Es trat ein Fehler auf.', 'izioseo') ?></p>
		</div>
	<? endif; ?>
<? endif; ?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<div class="wrap">
		<p style="float:left; width: 75px;">
			<input name="cmd" value="_donations" type="hidden">
			<input name="business" value="united20@united20.de" type="hidden">
			<input name="item_name" value="goizio.com Softwareprodukte" type="hidden">
			<input name="no_shipping" value="0" type="hidden">
			<input name="no_note" value="1" type="hidden">
			<input name="currency_code" value="EUR" type="hidden">
			<input name="tax" value="0" type="hidden">
			<input name="lc" value="DE" type="hidden">
			<input name="bn" value="PP-DonationsBF" type="hidden">
			<input alt="Jetzt einfach, schnell und sicher online bezahlen mit PayPal." name="submit" src="https://www.paypal.com/de_DE/DE/i/btn/x-click-butcc-donate.gif" type="image">
			<img src="https://www.paypal.com/de_DE/i/scr/pixel.gif" alt="" width="1" border="0" height="1"><br>
		</p>
		<p style="float:right; width: 885px; padding:7px 0px;"><? _e('Sie finden izioSEO super gelungen und m&ouml;chten uns helfen weitere Features und Funktionen f&uuml;r dieses Wordpress Plugin umzusetzen. Dann sagen Sie uns ihre W&uuml;nsche und Vorschl&auml;ge f&uuml;r izioSEO. Und spenden Sie uns den Betrag, wie Sie meinen, was izioSEO Ihnen wert ist!'); ?></p>
	</div>
</form>
<form method="post">
	<div class="wrap">
		<h2><? _e('izioSEO', 'izioseo'); ?></h2>
	</div>
	<div class="wrap">
		<p><? _e('Allgemeine Einstellungen f&uuml;r das izioSEO und den Wordpress Blog.', 'izioseo') ?></p>
		<table class="form-table">
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_rewrite_titles"><? _e('Seitentitel umschreiben:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_rewrite_titles]" id="izioseo_rewrite_titles"<? if ($data['izioseo_rewrite_titles'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('Schalten Sie das Umschreiben der Seitentitel an oder aus, um die standard Seitentitel zuverwenden oder die optimierten Seitentitel von izioSEO.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_title"><? _e('Seitentitel<br />(Standardwert / Startseite):', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_title]" id="izioseo_title" style="width: 450px;" value="<?= $data['izioseo_title'] ?> " />
					<div style="max-width: 750px; text-align: left; width: 100%;">
						<? _e('Definieren Sie hier den Titel f&uuml;r die Startseite und den Standardwert f&uuml;r die Unterseiten, falls keine seitenspezifischen Daten vorhanden sind. (empfohlene maximale L&auml;nge von ca. 60 Zeichen)', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_description"><? _e('META-Beschreibung<br />(Standardwert / Startseite):', 'izioseo') ?></label>
				</th>
				<td>
					<textarea name="izioseo[izioseo_description]" id="izioseo_description" style="width: 450px; height: 75px;"><?= $data['izioseo_description'] ?></textarea>
					<div style="max-width: 750px; text-align: left; width: 100%;">
						<? _e('Die META-Beschreibung f&uuml;r die Startseite und als Standardwert, wenn keine Beschreibung vorhanden ist. (empfohlene maximale L&auml;nge von ca. 170 Zeichen)', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_keywords"><? _e('META-Keywords<br />(Standardwert / Startseite):', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_keywords]" id="izioseo_keywords" style="width: 450px;" value="<?= $data['izioseo_keywords'] ?>" />
					<div style="max-width: 750px; text-align: left; width: 100%;">
						<? _e('Tragen Sie hier die Keywords f&uuml;r die Startseite ein. Diese Keywords werden als Standardwerte verwendet falls keine Keywords vorhanden sind. (empfohlene maximale L&auml;nge von ca. 100 Zeichen)', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_lang_id"><? _e('Sprache:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_lang_id]" id="izioseo_lang_id" size="2" value="<?= $data['izioseo_lang_id'] ?>" />
					<div style="max-width: 750px; text-align: left; width: 100%;">
						<? _e('Die L&auml;nderk&uuml;rzel nach ISO-Norm, wie z.B. \'de\' f&uuml;r Deutschland.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_analytics_type"><? _e('Google Analytics einbinden:', 'izioseo') ?></label>
				</th>
				<td>
					<select name="izioseo[izioseo_analytics_type]" id="izioseo_analytics_type" style="width: 150px;">
						<option value="urchin"<? if ($data['izioseo_analytics_type'] == 'urchin') : ?> selected<? endif; ?>><? _e('Alter Tracking Code', true) ?></option>
						<option value="ga"<? if ($data['izioseo_analytics_type'] == 'ga') : ?> selected<? endif; ?>><? _e('Neuer Tracking Code', true) ?></option>
					</select>
					<input type="text" name="izioseo[izioseo_analytics_tracking_id]" id="izioseo_analytics_tracking_id" style="width: 296px;" value="<?= $data['izioseo_analytics_tracking_id'] ?>" />
					<div style="max-width: 750px; text-align: left; width: 100%;">
						<? _e('W&auml;hlen Sie den Typ des Tracking Codes aus und geben Sie f&uuml;r Google Analytics die ID des Trackincodes ein. Dieser muss nach dem Schema \'UA-7694039-14\' eingegeben werden. Wird die Tracking ID weggelassen oder ist fehlerhaft, so wird der Analyticscode nicht eingebunden.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_wptools"><? _e('Google Webmastertools:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_wptools]" id="izioseo_wptools" style="width: 450px;" value="<?= $data['izioseo_wptools'] ?>" />
					<div style="max-width: 750px; text-align: left; width: 100%;">
						<? _e('Geben Sie die TrackingID f&uuml;r die Google Webmastertools ein. Dies geschieht nach dem Schema \'x6mHzfnvj849fJKVFjdmcie8rijXn/gW3SmElKgTH9Q=\'.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_google_adsection"><? _e('Google AdSection:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_google_adsection]" id="izioseo_google_adsection"<? if ($data['izioseo_google_adsection'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('Schalten Sie diese Option ein, um f&uuml;r Google AdSense genauere und relevantere Ergebnisse zu erziehlen.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_noindex_rssfeed"><? _e('RSS Feeds nicht indizieren:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_noindex_rssfeed]" id="izioseo_noindex_rssfeed"<? if ($data['izioseo_noindex_rssfeed'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('Versehen Sie die RSS Feeds mit dem NoIndex-Robots-Tag, um diese nicht f&uuml;r Suchmaschinen indizieren zu lassen.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_log"><? _e('Log-System aktivieren:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_log]" id="izioseo_log"<? if ($data['izioseo_log'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('Log-System aktivieren um Fehler mit anderen Plugins aufzusp&uuml;ren.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="wrap" style="padding-top: 35px;">
		<h2><? _e('META-Tag generieren', 'izioseo'); ?></h2>
	</div>
	<div class="wrap">
		<p><? _e('Einstellungen zum automatischen Generieren von META-Tags. Diese Optionen werden vorallem dann verwendet, wenn keine oder keine brauchbaren META-Tags worhanden sind.', 'izioseo') ?></p>
		<table class="form-table">
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_use_default"><? _e('Standardwerte verwenden:', 'izioseo') ?></label>
				</th>
				<td>
					<select name="izioseo[izioseo_use_default]" id="izioseo_use_default" style="width: 250px;">
						<option value="none"<? if ($data['izioseo_use_default'] == 'none') : ?> selected<? endif; ?>><? _e('keine META-Tags verwenden', true) ?></option>
						<option value="default"<? if ($data['izioseo_use_default'] == 'default') : ?> selected<? endif; ?>><? _e('Standardwerte verwenden', true) ?></option>
						<option value="generate"<? if ($data['izioseo_use_default'] == 'generate') : ?> selected<? endif; ?>><? _e('META-Daten aus Inhalt generieren', true) ?></option>
					</select>
					<div style="max-width: 750px; text-align: left; width: 100%;">
						<? _e('Was soll als Standardwerte verwendet werden, wenn keine META-Daten festgelegt wurden sind.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_collect_keywords"><? _e('Keywords sammeln:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_collect_keywords]" id="izioseo_collect_keywords"<? if ($data['izioseo_collect_keywords'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('Sollen die Keywords in der keywords.txt - Datei gesammelt werden, wenn die Generierung der META-Keywords und META-Description f&uuml;r die jeweilige Unterseite aktiviert ist. Dadurch k&ouml;nnen Sie auf einfache Weise ihre Stopword-Liste individuell erweitern.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_lenght_description"><? _e('Maximale Beschreibungsl&auml;nge:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_lenght_description]" id="izioseo_lenght_description" size="3" value="<?= $data['izioseo_lenght_description'] ?>" />
					<div style="max-width: 750px; text-align: left; width: 100%;">
						<? _e('Legen Sie die maximale L&auml;nge f&uuml;r die generierten META-Beschreibungen fest, wenn die META-Beschreibungen genieriert werden. Es wird eine maximale L&auml;nge von ca. 170 Zeichen empfohlen.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_lenght_keywords"><? _e('Maximale Anzahl an Keywords:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_lenght_keywords]" id="izioseo_lenght_keywords" size="3" value="<?= $data['izioseo_lenght_keywords'] ?>" />
					<div style="max-width: 750px; text-align: left; width: 100%;">
						<? _e('Legen Sie die maximale Anzahl f&uuml;r die generierten META-Keywords fest, wenn die META-Keywords genieriert werden. Es werden zwischen 5 und 7 Keywords empfohlen.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_use_categories"><? _e('Kategorien f&uuml;r Keywords mit einbeziehen:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_use_categories]" id="izioseo_use_categories"<? if ($data['izioseo_use_categories'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('Mit dem Aktivieren dieser Funktion beziehen Sie die Kategorien in die generierung der Keywords mit ein.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_use_tags"><? _e('Tags f&uuml;r Keywords mit einbeziehen:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_use_tags]" id="izioseo_use_tags"<? if ($data['izioseo_use_tags'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('Mit dem Aktivieren dieser Funktion beziehen Sie die Tags in die generierung der Keywords mit ein.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_robots_noodp"><? _e('noodp-Tag benutzen:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_robots_noodp]" id="izioseo_robots_noodp"<? if ($data['izioseo_robots_noodp'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('Die Seiten des Blogs nicht beim Open Directory Project indizieren.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_robots_noydir"><? _e('noydir-Tag benutzen:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_robots_noydir]" id="izioseo_robots_noydir"<? if ($data['izioseo_robots_noydir'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('Die Seiten des Blogs nicht beim Yahoo! Directory indizieren.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="wrap" style="padding-top: 35px;">
		<h2><? _e('Formatierung der Seitentitel', 'izioseo'); ?></h2>
	</div>
	<div class="wrap">
		<p><? _e('Legen Sie die Anordung und das Aussehen der Seitentitel fest und passen Sie diese nach ihren W&uuml;nschen und Vorstellungen an. Weitere Informationen zu Platzhaltern und Formatierungsm&ouml;glichkeiten finden sie auf der Website von <a href="http://www.izio-media.com/izioseo/" target="_blank">izioSEO</a>.', 'izioseo') ?></p>
		<table class="form-table">
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_format_title_post"><? _e('Blogbeitrag:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_format_title_post]" id="izioseo_format_title_post" style="width: 450px;" value="<?= $data['izioseo_format_title_post'] ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_format_title_page"><? _e('Statische Seiten:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_format_title_page]" id="izioseo_format_title_page" style="width: 450px;" value="<?= $data['izioseo_format_title_page'] ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_format_title_search"><? _e('Suchergebnisse:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_format_title_search]" id="izioseo_format_title_search" style="width: 450px;" value="<?= $data['izioseo_format_title_search'] ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_format_title_category"><? _e('Kategorie:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_format_title_category]" id="izioseo_format_title_category" style="width: 450px;" value="<?= $data['izioseo_format_title_category'] ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_format_title_paged"><? _e('Seiten mit Seitenzahl:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_format_title_paged]" id="izioseo_format_title_paged" style="width: 450px;" value="<?= $data['izioseo_format_title_paged'] ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_format_title_tag"><? _e('Tag:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_format_title_tag]" id="izioseo_format_title_tag" style="width: 450px;" value="<?= $data['izioseo_format_title_tag'] ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_format_title_archive"><? _e('Archiv:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_format_title_archive]" id="izioseo_format_title_archive" style="width: 450px;" value="<?= $data['izioseo_format_title_archive'] ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_format_title_404"><? _e('404-Fehlerseite:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_format_title_404]" id="izioseo_format_title_404" style="width: 450px;" value="<?= $data['izioseo_format_title_404'] ?>" />
				</td>
			</tr>
		</table>
	</div>
	<div class="wrap" style="padding-top: 35px;">
		<h2><? _e('Formatierung der Beschreibung', 'izioseo'); ?></h2>
	</div>
	<div class="wrap">
		<p><? _e('Passen Sie den Aufbau der Beschreibung an. Weitere Informationen finden Sie auf der Homepage von  <a href="http://www.izio-media.com/izioseo/" target="_blank">izioSEO</a>.', 'izioseo') ?></p>
		<table class="form-table">
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_format_description"><? _e('Formatierung der META-Beschreibung:', 'izioseo') ?></label>
				</th>
				<td>
					<input type="text" name="izioseo[izioseo_format_description]" id="izioseo_format_description" style="width: 450px;" value="<?= $data['izioseo_format_description'] ?>" />
				</td>
			</tr>
		</table>
	</div>
	<div class="wrap" style="padding-top: 35px;">
		<h2><? _e('META-Robots', 'izioseo'); ?></h2>
	</div>
	<div class="wrap">
		<p><? _e('Die allgemeinen Einstellungen der Robots als Standardwert f&uuml;r alle Bereiche des Blogs.', 'izioseo') ?></p>
		<table class="form-table">
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_robots_home"><? _e('Startseite', 'izioseo') ?></label>
				</th>
				<td>
					<select name="izioseo[izioseo_robots_home]" id="izioseo_robots_home">
						<? foreach ($robots as $robot) : ?>
							<option value="<?= $robot ?>"<? if ($data['izioseo_robots_home'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
						<? endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_robots_post"><? _e('Blogbeitrag:', 'izioseo') ?></label>
				</th>
				<td>
					<select name="izioseo[izioseo_robots_post]" id="izioseo_robots_post">
						<? foreach ($robots as $robot) : ?>
							<option value="<?= $robot ?>"<? if ($data['izioseo_robots_post'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
						<? endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_robots_page"><? _e('Statische Seiten:', 'izioseo') ?></label>
				</th>
				<td>
					<select name="izioseo[izioseo_robots_page]" id="izioseo_robots_page">
						<? foreach ($robots as $robot) : ?>
							<option value="<?= $robot ?>"<? if ($data['izioseo_robots_page'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
						<? endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_robots_search"><? _e('Suchergebnisse:', 'izioseo') ?></label>
				</th>
				<td>
					<select name="izioseo[izioseo_robots_search]" id="izioseo_robots_search">
						<? foreach ($robots as $robot) : ?>
							<option value="<?= $robot ?>"<? if ($data['izioseo_robots_search'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
						<? endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_robots_category"><? _e('Kategorie:', 'izioseo') ?></label>
				</th>
				<td>
					<select name="izioseo[izioseo_robots_category]" id="izioseo_robots_category">
						<? foreach ($robots as $robot) : ?>
							<option value="<?= $robot ?>"<? if ($data['izioseo_robots_category'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
						<? endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_robots_tag"><? _e('Tag:', 'izioseo') ?></label>
				</th>
				<td>
					<select name="izioseo[izioseo_robots_tag]" id="izioseo_robots_tag">
						<? foreach ($robots as $robot) : ?>
							<option value="<?= $robot ?>"<? if ($data['izioseo_robots_tag'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
						<? endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_robots_archive"><? _e('Archiv:', 'izioseo') ?></label>
				</th>
				<td>
					<select name="izioseo[izioseo_robots_archive]" id="izioseo_robots_archive">
						<? foreach ($robots as $robot) : ?>
							<option value="<?= $robot ?>"<? if ($data['izioseo_robots_archive'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
						<? endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_robots_404"><? _e('404-Fehlerseite:', 'izioseo') ?></label>
				</th>
				<td>
					<select name="izioseo[izioseo_robots_404]" id="izioseo_robots_404">
						<? foreach ($robots as $robot) : ?>
							<option value="<?= $robot ?>"<? if ($data['izioseo_robots_404'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
						<? endforeach; ?>
					</select>
				</td>
			</tr>
		</table>
	</div>
	<div class="wrap" style="padding-top: 35px;">
		<h2><? _e('Links auf rel="nofollow" setzen', 'izioseo'); ?></h2>
	</div>
	<div class="wrap">
		<p><? _e('Setzen Sie verschiedene Bereiche ihres Blogs auf rel="nofollow".', 'izioseo') ?></p>
		<table class="form-table">
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_nofollow_categories"><? _e('Kategorieliste', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_nofollow_categories]" id="izioseo_nofollow_categories"<? if ($data['izioseo_nofollow_categories'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('In der Liste der Kategorien werden alle Links auf rel="nofollow" gesetzt. Sowie die Liste der Kategorien f&uuml;r einen Blogbeitrag.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_nofollow_bookmarks"><? _e('Blogroll', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_nofollow_bookmarks]" id="izioseo_nofollow_bookmarks"<? if ($data['izioseo_nofollow_bookmarks'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('Setzt die Blogroll komplett auf rel="nofollow".', 'izioseo'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="izioseo_nofollow_bookmarks"><? _e('Tagcloud', 'izioseo') ?></label>
				</th>
				<td>
					<input type="checkbox" name="izioseo[izioseo_nofollow_tags]" id="izioseo_nofollow_tags"<? if ($data['izioseo_nofollow_tags'] == 'on') : ?> checked<? endif; ?> />
					<div style="max-width: 750px; text-align: left; width: 100%">
						<? _e('Alle Tags der Tagcloud werden auf rel="nofollow" gesetzt.', 'izioseo'); ?>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="wrap">
		<p class="submit">
			<input type="submit" value="<? _e('Speichern', 'izioseo')?> &raquo;" />
		</p>
	</div>
</form>
<form method="post">
	<div class="wrap" style="padding-top: 35px;">
		<h2><? _e('robots.txt bearbeiten', 'izioseo'); ?></h2>
	</div>
	<div class="wrap">
		<p><? _e('&Uuml;ber das Textfeld ist es m&ouml;glich die robots.txt, welche im Root der Wordpress-Installation liegt und Regeln f&uuml;r Suchmaschinenbots festlegt. Mehr Informationen zum Aufbau einer robots.txt finden sie unter: <a href="http://www.robotstxt.org" target="_blank">http://www.robotstxt.org/</a>', 'izioseo'); ?></p>
		<table class="form-table">
			<tr>
				<th scope="row" style="text-align:right; vertical-align:top;">
					<label for="file_robotstxt"><? _e('Inhalt robots.txt', 'izioseo') ?></label>
				</th>
				<td>
					<textarea name="robotstxt" id="file_robotstxt" style="width: 450px; height: 150px;"><?= $robotsTxt ?></textarea>
				</td>
			</tr>
		</table>
	</div>
	<div class="wrap">
		<p class="submit">
			<input type="submit" value="<? _e('robots.txt speichern', 'izioseo')?> &raquo;" />
		</p>
	</div>
</form>
<? if ($data['izioseo_collect_keywords'] == 'on') : ?>
	<form method="post">
		<div class="wrap" style="padding-top: 35px;">
			<h2><? _e('Stopwords mit Keywords verschmelzen', 'izioseo'); ?></h2>
		</div>
		<div class="wrap">
			<p><? _e('Bearbeiten Sie die Stopword-Liste und die Liste mit den Keywords und Akronymen. Dadurch k&ouml;nnen Sie geziehlt steuern, welche W&ouml;rter f&uuml;r die Generierung von META-Daten verwendet werden sollen.', 'izioseo'); ?></p>
			<table class="form-table">
				<tr>
					<th scope="row" style="text-align:right; vertical-align:top;">
						<label for="file_stopwords"><? _e('Stopword Liste', 'izioseo') ?></label>
					</th>
					<td>
						<textarea name="merge[file_stopwords]" id="file_stopwords" style="width: 450px; height: 150px;"><?= $merge['file_stopwords'] ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row" style="text-align:right; vertical-align:top;">
						<label for="file_keywords"><? _e('Keyword Liste', 'izioseo') ?></label>
					</th>
					<td>
						<textarea name="merge[file_keywords]" id="file_keywords" style="width: 450px; height: 150px;"><?= $merge['file_keywords'] ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row" style="text-align:right; vertical-align:top;">
						<label for="file_acronyms"><? _e('Acronyme', 'izioseo') ?></label>
					</th>
					<td>
						<textarea name="merge[file_acronyms]" id="file_acronyms" style="width: 450px; height: 150px;"><?= $merge['file_acronyms'] ?></textarea>
					</td>
				</tr>
			</table>
		</div>
		<div class="wrap">
			<p class="submit">
				<input type="submit" value="<? _e('Stopwords verschmelzen', 'izioseo')?> &raquo;" />
			</p>
		</div>
	</form>
<? endif; ?>
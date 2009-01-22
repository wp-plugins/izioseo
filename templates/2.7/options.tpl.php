<div class="wrap">
	<div class="icon32" style="background: url('<?= $this->images ?>/izioseo-dashboard.png') no-repeat;"><br /></div>
	<h2><? _e('izioSEO Wordpress SEO Plugin › Einstellungen', 'izioseo') ?></h2>
	<? if (isset($message)) : ?>
		<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204);">
			<p><? _e('Die Einstellungen f&uuml;r izioSEO wurden gespeichert.', 'izioseo') ?></p>
		</div>
	<? endif; ?>
	<form method="post">
		<h3><?= _e('Allgemeine Einstellungen', 'izioseo') ?></h3>
		<p><? _e('Allgemeine Einstellungen f&uuml;r das izioSEO und den Wordpress Blog.', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="izioseo_redirect_permalink"><?= $this->helpButton('301-Weiterleitung') ?> <? _e('301-Redirect f&uuml;r ge&auml;nderte URL\'s', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_redirect_permalink]" id="izioseo_redirect_permalink"<? if ($data['izioseo_redirect_permalink'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Es wird bei einer ge&auml;nderten Permalinkstruktur ein &quot;HTTP/1.1 301 Moved Permanently&quot; Header gesendet, damit Google die ge&auml;nderte Permalinkstruktur erkennt.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="izioseo_rewrite_titles"><?= $this->helpButton('Seitentitel umschreiben') ?> <? _e('Seitentitel umschreiben', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_rewrite_titles]" id="izioseo_rewrite_titles"<? if ($data['izioseo_rewrite_titles'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Schalten Sie das Umschreiben der Seitentitel an oder aus, um die standard Seitentitel zuverwenden oder die optimierten Seitentitel von izioSEO.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="izioseo_title"><?= $this->helpButton('Seitentitel') ?> <? _e('Seitentitel<br />(Standardwert / Startseite)', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_title]" id="izioseo_title" class="regular-text" value="<?= $data['izioseo_title'] ?> " />
						<div style="text-align:justify;">
							<? _e('Definieren Sie den Titel f&uuml;r die Startseite und den Standardwert f&uuml;r die Unterseiten, falls keine seitenspezifischen Daten vorhanden sind. (empfohlene maximale L&auml;nge von ca. 60 Zeichen)', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="izioseo_description"><?= $this->helpButton('META-Beschreibung') ?> <? _e('META-Beschreibung<br />(Standardwert / Startseite)', 'izioseo') ?></label></th>
					<td>
						<textarea name="izioseo[izioseo_description]" id="izioseo_description" style="width:325px; height: 75px;"><?= $data['izioseo_description'] ?></textarea>
						<div style="text-align:justify;">
							<? _e('Die META-Beschreibung f&uuml;r die Startseite und als Standardwert, wenn keine Beschreibung vorhanden ist. (empfohlene maximale L&auml;nge von ca. 170 Zeichen)', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="izioseo_keywords"><?= $this->helpButton('META-Keywords') ?> <? _e('META-Keywords<br />(Standardwert / Startseite)', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_keywords]" id="izioseo_keywords" class="regular-text" value="<?= $data['izioseo_keywords'] ?>" />
						<div style="text-align:justify;">
							<? _e('Tragen Sie die Keywords (Komma separiert) f&uuml;r die Startseite ein. Diese Keywords werden als Standardwerte verwendet, falls keine Keywords vorhanden sind oder generiert werden konnten. (empfohlene maximale L&auml;nge von ca. 100 Zeichen)', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Google Analytics Tracking') ?> <label for="izioseo_analytics_type"><? _e('Google Analytics einbinden', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_analytics_type]" id="izioseo_analytics_type" style="width: 150px;">
							<option value="urchin"<? if ($data['izioseo_analytics_type'] == 'urchin') : ?> selected<? endif; ?>><? _e('Alter Tracking Code', true) ?></option>
							<option value="ga"<? if ($data['izioseo_analytics_type'] == 'ga') : ?> selected<? endif; ?>><? _e('Neuer Tracking Code', true) ?></option>
						</select>
						<input type="text" name="izioseo[izioseo_analytics_tracking_id]" id="izioseo_analytics_tracking_id" style="width:168px;" value="<?= $data['izioseo_analytics_tracking_id'] ?>" />
						<div style="text-align:justify;">
							<? _e('W&auml;hlen Sie den Typ des Tracking Codes aus und geben Sie f&uuml;r Google Analytics die ID des Trackincodes ein. Dieser muss nach dem Schema \'UA-7694039-14\' eingegeben werden. Wird die Tracking ID weggelassen oder ist fehlerhaft, so wird der Analyticscode nicht eingebunden.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Google Webmastertools') ?> <label for="izioseo_wptools"><? _e('Google Webmastertools', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_wptools]" id="izioseo_wptools" class="regular-text" value="<?= $data['izioseo_wptools'] ?>" />
						<div style="text-align:justify;">
							<? _e('Geben Sie die TrackingID f&uuml;r die Google Webmastertools ein. Diese wird dann in einem META-Tag angegeben.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Google Adsection') ?> <label for="izioseo_google_adsection"><? _e('Google AdSection', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_google_adsection]" id="izioseo_google_adsection"<? if ($data['izioseo_google_adsection'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Schalten Sie diese Option ein, um f&uuml;r Google AdSense genauere und relevantere Ergebnisse zu erziehlen.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('RSS Feeds indexieren') ?> <label for="izioseo_noindex_rssfeed"><? _e('RSS Feeds nicht indexieren', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_noindex_rssfeed]" id="izioseo_noindex_rssfeed"<? if ($data['izioseo_noindex_rssfeed'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Versehen Sie die RSS Feeds mit dem NoIndex-Robots-Tag, um diese nicht f&uuml;r Suchmaschinen indizieren zu lassen.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Log-System') ?> <label for="izioseo_log"><? _e('Log-System aktivieren', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_log]" id="izioseo_log"<? if ($data['izioseo_log'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Log-System aktivieren um Fehler mit anderen Plugins aufzusp&uuml;ren.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?= _e('Generierung der META-Angaben', 'izioseo') ?></h3>
		<p><? _e('Einstellungen zum automatischen Generieren von META-Tags.', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?= $this->helpButton('Verwendung von Standardwerten') ?> <label for="izioseo_use_default"><? _e('Standardwerte verwenden', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_use_default]" id="izioseo_use_default">
							<option value="none"<? if ($data['izioseo_use_default'] == 'none') : ?> selected<? endif; ?>><? _e('keine META-Tags verwenden', true) ?></option>
							<option value="default"<? if ($data['izioseo_use_default'] == 'default') : ?> selected<? endif; ?>><? _e('Standardwerte verwenden', true) ?></option>
							<option value="generate"<? if ($data['izioseo_use_default'] == 'generate') : ?> selected<? endif; ?>><? _e('META-Daten aus Inhalt generieren', true) ?></option>
						</select>
						<div style="text-align:justify;">
							<? _e('Was soll als Standardwerte verwendet werden, unter der Bedingung das keine META-Daten festgelegt wurden sind.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('L&auml;nge der META-Beschreibung') ?> <label for="izioseo_lenght_description"><? _e('Beschreibungsl&auml;nge', 'izioseo') ?></label></th>
					<td>
						<? _e('minimale L&auml;nge', 'izioseo') ?> <input type="text" name="izioseo[izioseo_lenght_description_min]" id="izioseo_lenght_description_min" size="3" value="<?= $data['izioseo_lenght_description_min'] ?>" /> <? _e('Zeichen', 'izioseo') ?>,
						<? _e('maximale L&auml;nge', 'izioseo') ?> <input type="text" name="izioseo[izioseo_lenght_description]" id="izioseo_lenght_description" size="3" value="<?= $data['izioseo_lenght_description'] ?>" /> <? _e('Zeichen', 'izioseo') ?>
						<div style="text-align:justify;">
							<? _e('Legen Sie die maximale und minimale L&auml;nge f&uuml;r die generierten META-Beschreibungen fest. Es wird eine maximale L&auml;nge von ca. 170 Zeichen empfohlen. Wird die minimale L&auml;nge der Beschreibung unterschritten, so werden aus dem Text, je nachdem wie Lang die maximale Beschreibungsl&auml;nge ist, die ersten S&auml;tze extrahiert.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Anzahl der META-Keywords') ?> <label for="izioseo_lenght_keywords"><? _e('Maximale Anzahl an Keywords', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_lenght_keywords]" id="izioseo_lenght_keywords" size="3" value="<?= $data['izioseo_lenght_keywords'] ?>" /> <? _e('W&ouml;rter', 'izioseo') ?>
						<div style="text-align:justify;">
							<? _e('Legen Sie die maximale Anzahl f&uuml;r die generierten META-Keywords fest. Maximale empfohlene Anzahl an Keywords zwischen 5 und 7 Keywords.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Kategorien in META-Keywords einbeziehen') ?> <label for="izioseo_use_categories"><? _e('Kategorien in die Keywords mit einbeziehen', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_use_categories]" id="izioseo_use_categories"<? if ($data['izioseo_use_categories'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Mit dem Aktivieren dieser Funktion beziehen Sie die Kategorien in die Generierung der Keywords mit ein.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Tags in META-Keywords einbeziehen') ?> <label for="izioseo_use_tags"><? _e('Tags in die Keywords mit einbeziehen', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_use_tags]" id="izioseo_use_tags"<? if ($data['izioseo_use_tags'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Mit dem Aktivieren dieser Funktion werden die Tags in die Generierung der Keywords mit einbezogen.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Referer in META-Keywords einbeziehen') ?> <label for="izioseo_use_referers"><? _e('Referer in die Keywords mit einbeziehen', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_use_referers]" id="izioseo_use_referers"<? if ($data['izioseo_use_referers'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Beziehen Sie die Suchanfragen aus verschiedenen Suchmaschinen mit in die Keywords ein.<br /><strong>Hinweis:</strong> Dies hilf die Keywords f&uuml;r die jeweilige Seite weiter zu optimieren, kann aber auch negative Auswirkungen besitzen.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('noodp-Tag in META-Robots') ?> <label for="izioseo_robots_noodp"><? _e('noodp-Tag benutzen', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_robots_noodp]" id="izioseo_robots_noodp"<? if ($data['izioseo_robots_noodp'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Die Seiten des Blogs nicht beim Open Directory Project indizieren.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('noydir-Tag in META-Robots') ?> <label for="izioseo_robots_noydir"><? _e('noydir-Tag benutzen', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_robots_noydir]" id="izioseo_robots_noydir"<? if ($data['izioseo_robots_noydir'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Die Seiten des Blogs nicht beim Yahoo! Directory indizieren.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?= _e('Formatierung der Seitentitel', 'izioseo') ?></h3>
		<p><? _e('Legen Sie die Anordung und das Aussehen der Seitentitel fest und passen Sie diese nach ihren W&uuml;nschen und Vorstellungen an. Es k&ouml;nnen die folgenden Platzhalter verwendet werden', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?= $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_post"><? _e('Blogbeitrag', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_post]" id="izioseo_format_title_post" class="regular-text" value="<?= $data['izioseo_format_title_post'] ?>" />
						<div style="text-align:justify;">
							<? _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_post')" id="link_izioseo_format_title_post"><? _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_post" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <? _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <? _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%post_title%</b> - <? _e('Titel des Blogbeitrages', 'izioseo') ?></li>
								<li><b>%post_author_login%</b> - <? _e('Loginname des Autors', 'izioseo') ?></li>
								<li><b>%post_author_nicename%</b> - <? _e('Benutzername des Autors', 'izioseo') ?></li>
								<li><b>%post_author_firstname%</b> - <? _e('Vorname des Autors', 'izioseo') ?></li>
								<li><b>%post_author_lastname%</b> - <? _e('Nachname des Autors', 'izioseo') ?></li>
								<li><b>%category_title%</b> - <? _e('Name der Kategorie', 'izioseo') ?></li>
								<li><b>%page%</b> - <? _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_page"><? _e('Statische Seiten', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_page]" id="izioseo_format_title_page" class="regular-text" value="<?= $data['izioseo_format_title_page'] ?>" />
						<div style="text-align:justify;">
							<? _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_page')" id="link_izioseo_format_title_page"><? _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_page" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <? _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <? _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%page_title%</b> - <? _e('Name der statischen Seite', 'izioseo') ?></li>
								<li><b>%page_author_login%</b> - <? _e('Loginname des Autors', 'izioseo') ?></li>
								<li><b>%page_author_nicename%</b> - <? _e('Benutzername des Autors', 'izioseo') ?></li>
								<li><b>%page_author_firstname%</b> - <? _e('Vorname des Autors', 'izioseo') ?></li>
								<li><b>%page_author_lastname%</b> - <? _e('Nachname des Autors', 'izioseo') ?></li>
								<li><b>%page%</b> - <? _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_search"><? _e('Suchergebnisse', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_search]" id="izioseo_format_title_search" class="regular-text" value="<?= $data['izioseo_format_title_search'] ?>" />
						<div style="text-align:justify;">
							<? _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_search')" id="link_izioseo_format_title_search"><? _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_search" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <? _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <? _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%search%</b> - <? _e('Suchbegriff aus der Suche', 'izioseo') ?></li>
								<li><b>%page%</b> - <? _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_category"><? _e('Kategorie', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_category]" id="izioseo_format_title_category" class="regular-text" value="<?= $data['izioseo_format_title_category'] ?>" />
						<div style="text-align:justify;">
							<? _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_category')" id="link_izioseo_format_title_category"><? _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_category" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <? _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <? _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%category_title%</b> - <? _e('Name der Kategorie', 'izioseo') ?></li>
								<li><b>%category_description%</b> - <? _e('Beschreibung der Kategorie', 'izioseo') ?></li>
								<li><b>%page%</b> - <? _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_paged"><? _e('Seiten mit Seitenzahl', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_paged]" id="izioseo_format_title_paged" class="regular-text" value="<?= $data['izioseo_format_title_paged'] ?>" />
						<div style="text-align:justify;">
							<? _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_paged')" id="link_izioseo_format_title_paged"><? _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_paged" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%page%</b> - <? _e('Seitenzahl', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_tag"><? _e('Tag', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_tag]" id="izioseo_format_title_tag" class="regular-text" value="<?= $data['izioseo_format_title_tag'] ?>" />
						<div style="text-align:justify;">
							<? _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_tag')" id="link_izioseo_format_title_tag"><? _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_tag" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <? _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <? _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%tag%</b> - <? _e('Tag / Schlagwort', 'izioseo') ?></li>
								<li><b>%page%</b> - <? _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_archive"><? _e('Archiv', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_archive]" id="izioseo_format_title_archive" class="regular-text" value="<?= $data['izioseo_format_title_archive'] ?>" />
						<div style="text-align:justify;">
							<? _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_archive')" id="link_izioseo_format_title_archive"><? _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_archive" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <? _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <? _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%date%</b> - <? _e('Datum des Archivs', 'izioseo') ?></li>
								<li><b>%page%</b> - <? _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_404"><? _e('404-Fehlerseite', 'izioseo') ?></label>
					</th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_404]" id="izioseo_format_title_404" class="regular-text" value="<?= $data['izioseo_format_title_404'] ?>" />
						<div style="max-width: 750px; text-align: left; width: 100%">
							<? _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_404')" id="link_izioseo_format_title_404"><? _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_404" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <? _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <? _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%request_url%</b> - <? _e('URL von Fehlerseite', 'izioseo') ?></li>
								<li><b>%request_words%</b> - <? _e('Extrahierten W&ouml;rter aus der URL', 'izioseo') ?></li>
								<li><b>%page%</b> - <? _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?= _e('Formatierung der Beschreibung', 'izioseo') ?></h3>
		<p><? _e('Passen Sie den Aufbau der META-Beschreibung an.', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?= $this->helpButton('Formatierung der META-Beschreibung') ?> <label for="izioseo_format_description"><? _e('Formatierung der META-Beschreibung', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_description]" id="izioseo_format_description" class="regular-text" value="<?= $data['izioseo_format_description'] ?>" />
						<div style="text-align:justify;">
							<? _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_description')" id="link_izioseo_format_description"><? _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_description" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%description%</b> - <? _e('META-Beschreibung', 'izioseo') ?></li>
								<li><b>%wp_title%</b> - <? _e('Titel der aktuellen Seite', 'izioseo') ?></li>
								<li><b>%blog_title%</b> - <? _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <? _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%category%</b> - <? _e('Beschreibung der aktuellen Kategorie', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?= _e('META-Robots', 'izioseo') ?></h3>
		<p><? _e('Die allgemeinen Einstellungen der Robots als Standardwert f&uuml;r alle Bereiche des Blogs.', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?= $this->helpButton('META-Robots') ?> <label for="izioseo_robots_home"><? _e('Startseite', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_home]" id="izioseo_robots_home">
							<? foreach ($robots as $robot) : ?>
								<option value="<?= $robot ?>"<? if ($data['izioseo_robots_home'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
							<? endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('META-Robots') ?> <label for="izioseo_robots_post"><? _e('Blogbeitrag', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_post]" id="izioseo_robots_post">
							<? foreach ($robots as $robot) : ?>
								<option value="<?= $robot ?>"<? if ($data['izioseo_robots_post'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
							<? endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('META-Robots') ?> <label for="izioseo_robots_page"><? _e('Statische Seiten', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_page]" id="izioseo_robots_page">
							<? foreach ($robots as $robot) : ?>
								<option value="<?= $robot ?>"<? if ($data['izioseo_robots_page'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
							<? endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('META-Robots') ?> <label for="izioseo_robots_search"><? _e('Suchergebnisse', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_search]" id="izioseo_robots_search">
							<? foreach ($robots as $robot) : ?>
								<option value="<?= $robot ?>"<? if ($data['izioseo_robots_search'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
							<? endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('META-Robots') ?> <label for="izioseo_robots_category"><? _e('Kategorie', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_category]" id="izioseo_robots_category">
							<? foreach ($robots as $robot) : ?>
								<option value="<?= $robot ?>"<? if ($data['izioseo_robots_category'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
							<? endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('META-Robots') ?> <label for="izioseo_robots_tag"><? _e('Tag', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_tag]" id="izioseo_robots_tag">
							<? foreach ($robots as $robot) : ?>
								<option value="<?= $robot ?>"<? if ($data['izioseo_robots_tag'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
							<? endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('META-Robots') ?> <label for="izioseo_robots_archive"><? _e('Archiv', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_archive]" id="izioseo_robots_archive">
							<? foreach ($robots as $robot) : ?>
								<option value="<?= $robot ?>"<? if ($data['izioseo_robots_archive'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
							<? endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('META-Robots') ?> <label for="izioseo_robots_404"><? _e('404-Fehlerseite', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_404]" id="izioseo_robots_404">
							<? foreach ($robots as $robot) : ?>
								<option value="<?= $robot ?>"<? if ($data['izioseo_robots_404'] == $robot) : ?> selected<? endif; ?>><?= $robot ?></option>
							<? endforeach; ?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?= _e('Bilder Suchmaschinenfreundlich optimieren', 'izioseo') ?></h3>
		<p><? _e('Durch die folgenden Funktionen bestimmen Sie, ob die Bilder konform mit alt-Attribut und suchmaschinenfreundlicher Bezeichnung versehen werden sollen.', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?= $this->helpButton('Suchmaschinenfreundliche Bilder') ?> <label for="izioseo_image_use"><? _e('Bilder optimieren', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_image_use]" id="izioseo_image_use"<? if ($data['izioseo_image_use'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Sollen &lt;img ... /&gt; - Tags in Artikeln und Seiten suchmaschinenoptimiert dargestellt werden. Diese Funktion kann separat f&uuml;r jeden Artikel und jede Seite deaktiviert werden.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Suchmaschinenfreundliche Bilder') ?> <label for="izioseo_image_alt"><? _e('Formatierung des alt-Attributes', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_image_alt]" id="izioseo_image_alt" class="regular-text" value="<?= $data['izioseo_image_alt'] ?>" />
						<div style="text-align:justify;">
							<? _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_image_alt')" id="link_izioseo_image_alt"><? _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_image_alt" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <? _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%post_title%</b> - <? _e('Titel des Blogbeitrages', 'izioseo') ?></li>
								<li><b>%post_author_login%</b> - <? _e('Loginname des Autors', 'izioseo') ?></li>
								<li><b>%post_author_nicename%</b> - <? _e('Benutzername des Autors', 'izioseo') ?></li>
								<li><b>%post_author_firstname%</b> - <? _e('Vorname des Autors', 'izioseo') ?></li>
								<li><b>%post_author_lastname%</b> - <? _e('Nachname des Autors', 'izioseo') ?></li>
								<li><b>%category_title%</b> - <? _e('Name der Kategorie', 'izioseo') ?></li>
								<li><b>%image_title%</b> - <? _e('Titel des Bildes', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?= _e('Links auf rel="nofollow" setzen', 'izioseo') ?></h3>
		<p><? _e('Setzen Sie verschiedene Funktionen ihres Blogs auf rel="nofollow".', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?= $this->helpButton('Links mit rel="nofollow"') ?> <label for="izioseo_nofollow_categories"><? _e('Kategorieliste', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_nofollow_categories]" id="izioseo_nofollow_categories"<? if ($data['izioseo_nofollow_categories'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('In der Liste der Kategorien werden alle Links auf rel="nofollow" gesetzt. Sowie die Liste der Kategorien f&uuml;r einen Blogbeitrag.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Links mit rel="nofollow"') ?> <label for="izioseo_nofollow_bookmarks"><? _e('Blogroll', 'izioseo') ?></label>
					</th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_nofollow_bookmarks]" id="izioseo_nofollow_bookmarks"<? if ($data['izioseo_nofollow_bookmarks'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Setzt die Blogroll komplett auf rel="nofollow".', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?= $this->helpButton('Links mit rel="nofollow"') ?> <label for="izioseo_nofollow_bookmarks"><? _e('Tagcloud', 'izioseo') ?></label>
					</th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_nofollow_tags]" id="izioseo_nofollow_tags"<? if ($data['izioseo_nofollow_tags'] == 'on') : ?> checked<? endif; ?> />
						<div style="text-align:justify;">
							<? _e('Alle Tags der Tagcloud werden auf rel="nofollow" gesetzt.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="<? _e('Einstellungen speichern', 'izioseo')?>" />
		</p>
	</form>
</div>
<script type="text/javascript" language="JavaScript">
<!--

	function toggleDisplay(id)
	{
		var a = document.getElementById('link_' + id);
		var d = document.getElementById('placeholder_' + id);
		if (d.style.display == 'none')
		{
			a.innerHTML = '<?= __('verbergen', 'izioseo') ?>';
			d.style.display = 'block';
		}
		else
		{
			a.innerHTML = '<?= __('anzeigen', 'izioseo') ?>';
			d.style.display = 'none';
		}
	}

//-->
</script>

<div class="wrap">
	<div class="icon32" style="background: url('<?php echo $this->images ?>/izioseo-dashboard.png') no-repeat;"><br /></div>
	<h2><?php _e('izioSEO Wordpress SEO Plugin › Einstellungen', 'izioseo') ?></h2>
	<?php if (isset($message)) : ?>
		<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204);">
			<p><?php _e('Die Einstellungen f&uuml;r izioSEO wurden gespeichert.', 'izioseo') ?></p>
		</div>
	<?php endif; ?>
	<form method="post">
		<h3><?php echo _e('Allgemeine Einstellungen', 'izioseo') ?></h3>
		<p><?php _e('Allgemeine Einstellungen f&uuml;r das izioSEO und den Wordpress Blog.', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="izioseo_redirect_permalink"><?php echo $this->helpButton('301-Weiterleitung') ?> <?php _e('301-Redirect f&uuml;r ge&auml;nderte URL\'s', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_redirect_permalink]" id="izioseo_redirect_permalink"<?php if ($data['izioseo_redirect_permalink'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Es wird bei einer ge&auml;nderten Permalinkstruktur ein &quot;HTTP/1.1 301 Moved Permanently&quot; Header gesendet, damit Google die ge&auml;nderte Permalinkstruktur erkennt.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="izioseo_rewrite_titles"><?php echo $this->helpButton('Seitentitel umschreiben') ?> <?php _e('Seitentitel umschreiben', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_rewrite_titles]" id="izioseo_rewrite_titles"<?php if ($data['izioseo_rewrite_titles'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Schalten Sie das Umschreiben der Seitentitel an oder aus, um die standard Seitentitel zuverwenden oder die optimierten Seitentitel von izioSEO.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="izioseo_title"><?php echo $this->helpButton('Seitentitel') ?> <?php _e('Seitentitel<br />(Standardwert / Startseite)', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_title]" id="izioseo_title" class="regular-text" value="<?php echo $data['izioseo_title'] ?> " />
						<div style="text-align:justify;">
							<?php _e('Definieren Sie den Titel f&uuml;r die Startseite und den Standardwert f&uuml;r die Unterseiten, falls keine seitenspezifischen Daten vorhanden sind. (empfohlene maximale L&auml;nge von ca. 60 Zeichen)', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="izioseo_description"><?php echo $this->helpButton('META-Beschreibung') ?> <?php _e('META-Beschreibung<br />(Standardwert / Startseite)', 'izioseo') ?></label></th>
					<td>
						<textarea name="izioseo[izioseo_description]" id="izioseo_description" style="width:325px; height: 75px;"><?php echo $data['izioseo_description'] ?></textarea>
						<div style="text-align:justify;">
							<?php _e('Die META-Beschreibung f&uuml;r die Startseite und als Standardwert, wenn keine Beschreibung vorhanden ist. (empfohlene maximale L&auml;nge von ca. 170 Zeichen)', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="izioseo_keywords"><?php echo $this->helpButton('META-Keywords') ?> <?php _e('META-Keywords<br />(Standardwert / Startseite)', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_keywords]" id="izioseo_keywords" class="regular-text" value="<?php echo $data['izioseo_keywords'] ?>" />
						<div style="text-align:justify;">
							<?php _e('Tragen Sie die Keywords (Komma separiert) f&uuml;r die Startseite ein. Diese Keywords werden als Standardwerte verwendet, falls keine Keywords vorhanden sind oder generiert werden konnten. (empfohlene maximale L&auml;nge von ca. 100 Zeichen)', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Google Analytics Tracking') ?> <label for="izioseo_analytics_type"><?php _e('Google Analytics einbinden', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_analytics_type]" id="izioseo_analytics_type" style="width: 150px;">
							<option value="urchin"<?php if ($data['izioseo_analytics_type'] == 'urchin') : ?> selected<?php endif; ?>><?php _e('Alter Tracking Code', true) ?></option>
							<option value="ga"<?php if ($data['izioseo_analytics_type'] == 'ga') : ?> selected<?php endif; ?>><?php _e('Neuer Tracking Code', true) ?></option>
						</select>
						<input type="text" name="izioseo[izioseo_analytics_tracking_id]" id="izioseo_analytics_tracking_id" style="width:168px;" value="<?php echo $data['izioseo_analytics_tracking_id'] ?>" />
						<div style="text-align:justify;">
							<?php _e('W&auml;hlen Sie den Typ des Tracking Codes aus und geben Sie f&uuml;r Google Analytics die ID des Trackincodes ein. Dieser muss nach dem Schema \'UA-7694039-14\' eingegeben werden. Wird die Tracking ID weggelassen oder ist fehlerhaft, so wird der Analyticscode nicht eingebunden.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Google Webmastertools') ?> <label for="izioseo_wptools"><?php _e('Google Webmastertools', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_wptools]" id="izioseo_wptools" class="regular-text" value="<?php echo $data['izioseo_wptools'] ?>" />
						<div style="text-align:justify;">
							<?php _e('Geben Sie die TrackingID f&uuml;r die Google Webmastertools ein. Diese wird dann in einem META-Tag angegeben.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Google Adsection') ?> <label for="izioseo_google_adsection"><?php _e('Google AdSection', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_google_adsection]" id="izioseo_google_adsection"<?php if ($data['izioseo_google_adsection'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Schalten Sie diese Option ein, um f&uuml;r Google AdSense genauere und relevantere Ergebnisse zu erziehlen.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('RSS Feeds indexieren') ?> <label for="izioseo_noindex_rssfeed"><?php _e('RSS Feeds nicht indexieren', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_noindex_rssfeed]" id="izioseo_noindex_rssfeed"<?php if ($data['izioseo_noindex_rssfeed'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Versehen Sie die RSS Feeds mit dem NoIndex-Robots-Tag, um diese nicht f&uuml;r Suchmaschinen indizieren zu lassen.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?php echo _e('Generierung der META-Angaben', 'izioseo') ?></h3>
		<p><?php _e('Einstellungen zum automatischen Generieren von META-Tags.', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Verwendung von Standardwerten') ?> <label for="izioseo_use_default"><?php _e('Standardwerte verwenden', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_use_default]" id="izioseo_use_default">
							<option value="none"<?php if ($data['izioseo_use_default'] == 'none') : ?> selected<?php endif; ?>><?php _e('keine META-Tags verwenden', true) ?></option>
							<option value="default"<?php if ($data['izioseo_use_default'] == 'default') : ?> selected<?php endif; ?>><?php _e('Standardwerte verwenden', true) ?></option>
							<option value="generate"<?php if ($data['izioseo_use_default'] == 'generate') : ?> selected<?php endif; ?>><?php _e('META-Daten aus Inhalt generieren', true) ?></option>
						</select>
						<div style="text-align:justify;">
							<?php _e('Was soll als Standardwerte verwendet werden, unter der Bedingung das keine META-Daten festgelegt wurden sind.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('L&auml;nge der META-Beschreibung') ?> <label for="izioseo_lenght_description"><?php _e('Beschreibungsl&auml;nge', 'izioseo') ?></label></th>
					<td>
						<?php _e('minimale L&auml;nge', 'izioseo') ?> <input type="text" name="izioseo[izioseo_lenght_description_min]" id="izioseo_lenght_description_min" size="3" value="<?php echo $data['izioseo_lenght_description_min'] ?>" /> <?php _e('Zeichen', 'izioseo') ?>,
						<?php _e('maximale L&auml;nge', 'izioseo') ?> <input type="text" name="izioseo[izioseo_lenght_description]" id="izioseo_lenght_description" size="3" value="<?php echo $data['izioseo_lenght_description'] ?>" /> <?php _e('Zeichen', 'izioseo') ?>
						<div style="text-align:justify;">
							<?php _e('Legen Sie die maximale und minimale L&auml;nge f&uuml;r die generierten META-Beschreibungen fest. Es wird eine maximale L&auml;nge von ca. 170 Zeichen empfohlen. Wird die minimale L&auml;nge der Beschreibung unterschritten, so werden aus dem Text, je nachdem wie Lang die maximale Beschreibungsl&auml;nge ist, die ersten S&auml;tze extrahiert.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Anzahl der META-Keywords') ?> <label for="izioseo_lenght_keywords"><?php _e('Maximale Anzahl an Keywords', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_lenght_keywords]" id="izioseo_lenght_keywords" size="3" value="<?php echo $data['izioseo_lenght_keywords'] ?>" /> <?php _e('W&ouml;rter', 'izioseo') ?>
						<div style="text-align:justify;">
							<?php _e('Legen Sie die maximale Anzahl f&uuml;r die generierten META-Keywords fest. Maximale empfohlene Anzahl an Keywords zwischen 5 und 7 Keywords.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Kategorien in META-Keywords einbeziehen') ?> <label for="izioseo_use_categories"><?php _e('Kategorien in die Keywords mit einbeziehen', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_use_categories]" id="izioseo_use_categories"<?php if ($data['izioseo_use_categories'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Mit dem Aktivieren dieser Funktion beziehen Sie die Kategorien in die Generierung der Keywords mit ein.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Tags in META-Keywords einbeziehen') ?> <label for="izioseo_use_tags"><?php _e('Tags in die Keywords mit einbeziehen', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_use_tags]" id="izioseo_use_tags"<?php if ($data['izioseo_use_tags'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Mit dem Aktivieren dieser Funktion werden die Tags in die Generierung der Keywords mit einbezogen.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Referer in META-Keywords einbeziehen') ?> <label for="izioseo_use_referers"><?php _e('Referer in die Keywords mit einbeziehen', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_use_referers]" id="izioseo_use_referers"<?php if ($data['izioseo_use_referers'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Beziehen Sie die Suchanfragen aus verschiedenen Suchmaschinen mit in die Keywords ein.<br /><strong>Hinweis:</strong> Dies hilf die Keywords f&uuml;r die jeweilige Seite weiter zu optimieren, kann aber auch negative Auswirkungen besitzen.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('noodp-Tag in META-Robots') ?> <label for="izioseo_robots_noodp"><?php _e('noodp-Tag benutzen', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_robots_noodp]" id="izioseo_robots_noodp"<?php if ($data['izioseo_robots_noodp'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Die Seiten des Blogs nicht beim Open Directory Project indizieren.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?php echo _e('Formatierung der Seitentitel', 'izioseo') ?></h3>
		<p><?php _e('Legen Sie die Anordung und das Aussehen der Seitentitel fest und passen Sie diese nach ihren W&uuml;nschen und Vorstellungen an. Es k&ouml;nnen die folgenden Platzhalter verwendet werden', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_post"><?php _e('Blogbeitrag', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_post]" id="izioseo_format_title_post" class="regular-text" value="<?php echo $data['izioseo_format_title_post'] ?>" />
						<div style="text-align:justify;">
							<?php _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_post')" id="link_izioseo_format_title_post"><?php _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_post" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <?php _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <?php _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%post_title%</b> - <?php _e('Titel des Blogbeitrages', 'izioseo') ?></li>
								<li><b>%post_author_login%</b> - <?php _e('Loginname des Autors', 'izioseo') ?></li>
								<li><b>%post_author_nicename%</b> - <?php _e('Benutzername des Autors', 'izioseo') ?></li>
								<li><b>%post_author_firstname%</b> - <?php _e('Vorname des Autors', 'izioseo') ?></li>
								<li><b>%post_author_lastname%</b> - <?php _e('Nachname des Autors', 'izioseo') ?></li>
								<li><b>%category_title%</b> - <?php _e('Name der Kategorie', 'izioseo') ?></li>
								<li><b>%page%</b> - <?php _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_page"><?php _e('Statische Seiten', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_page]" id="izioseo_format_title_page" class="regular-text" value="<?php echo $data['izioseo_format_title_page'] ?>" />
						<div style="text-align:justify;">
							<?php _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_page')" id="link_izioseo_format_title_page"><?php _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_page" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <?php _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <?php _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%page_title%</b> - <?php _e('Name der statischen Seite', 'izioseo') ?></li>
								<li><b>%page_author_login%</b> - <?php _e('Loginname des Autors', 'izioseo') ?></li>
								<li><b>%page_author_nicename%</b> - <?php _e('Benutzername des Autors', 'izioseo') ?></li>
								<li><b>%page_author_firstname%</b> - <?php _e('Vorname des Autors', 'izioseo') ?></li>
								<li><b>%page_author_lastname%</b> - <?php _e('Nachname des Autors', 'izioseo') ?></li>
								<li><b>%page%</b> - <?php _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_search"><?php _e('Suchergebnisse', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_search]" id="izioseo_format_title_search" class="regular-text" value="<?php echo $data['izioseo_format_title_search'] ?>" />
						<div style="text-align:justify;">
							<?php _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_search')" id="link_izioseo_format_title_search"><?php _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_search" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <?php _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <?php _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%search%</b> - <?php _e('Suchbegriff aus der Suche', 'izioseo') ?></li>
								<li><b>%page%</b> - <?php _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_category"><?php _e('Kategorie', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_category]" id="izioseo_format_title_category" class="regular-text" value="<?php echo $data['izioseo_format_title_category'] ?>" />
						<div style="text-align:justify;">
							<?php _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_category')" id="link_izioseo_format_title_category"><?php _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_category" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <?php _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <?php _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%category_title%</b> - <?php _e('Name der Kategorie', 'izioseo') ?></li>
								<li><b>%category_description%</b> - <?php _e('Beschreibung der Kategorie', 'izioseo') ?></li>
								<li><b>%page%</b> - <?php _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_paged"><?php _e('Seiten mit Seitenzahl', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_paged]" id="izioseo_format_title_paged" class="regular-text" value="<?php echo $data['izioseo_format_title_paged'] ?>" />
						<div style="text-align:justify;">
							<?php _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_paged')" id="link_izioseo_format_title_paged"><?php _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_paged" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%page%</b> - <?php _e('Seitenzahl', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_tag"><?php _e('Tag', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_tag]" id="izioseo_format_title_tag" class="regular-text" value="<?php echo $data['izioseo_format_title_tag'] ?>" />
						<div style="text-align:justify;">
							<?php _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_tag')" id="link_izioseo_format_title_tag"><?php _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_tag" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <?php _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <?php _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%tag%</b> - <?php _e('Tag / Schlagwort', 'izioseo') ?></li>
								<li><b>%page%</b> - <?php _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_archive"><?php _e('Archiv', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_archive]" id="izioseo_format_title_archive" class="regular-text" value="<?php echo $data['izioseo_format_title_archive'] ?>" />
						<div style="text-align:justify;">
							<?php _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_archive')" id="link_izioseo_format_title_archive"><?php _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_archive" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <?php _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <?php _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%date%</b> - <?php _e('Datum des Archivs', 'izioseo') ?></li>
								<li><b>%page%</b> - <?php _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Formatierung des Seitentitels') ?> <label for="izioseo_format_title_404"><?php _e('404-Fehlerseite', 'izioseo') ?></label>
					</th>
					<td>
						<input type="text" name="izioseo[izioseo_format_title_404]" id="izioseo_format_title_404" class="regular-text" value="<?php echo $data['izioseo_format_title_404'] ?>" />
						<div style="max-width: 750px; text-align: left; width: 100%">
							<?php _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_title_404')" id="link_izioseo_format_title_404"><?php _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_title_404" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <?php _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <?php _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%request_url%</b> - <?php _e('URL von Fehlerseite', 'izioseo') ?></li>
								<li><b>%request_words%</b> - <?php _e('Extrahierten W&ouml;rter aus der URL', 'izioseo') ?></li>
								<li><b>%page%</b> - <?php _e('Seitenzahl positionieren', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?php echo _e('Formatierung der Beschreibung', 'izioseo') ?></h3>
		<p><?php _e('Passen Sie den Aufbau der META-Beschreibung an.', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Formatierung der META-Beschreibung') ?> <label for="izioseo_format_description"><?php _e('Formatierung der META-Beschreibung', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_format_description]" id="izioseo_format_description" class="regular-text" value="<?php echo $data['izioseo_format_description'] ?>" />
						<div style="text-align:justify;">
							<?php _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_format_description')" id="link_izioseo_format_description"><?php _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_format_description" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%description%</b> - <?php _e('META-Beschreibung', 'izioseo') ?></li>
								<li><b>%wp_title%</b> - <?php _e('Titel der aktuellen Seite', 'izioseo') ?></li>
								<li><b>%blog_title%</b> - <?php _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%blog_description%</b> - <?php _e('Beschreibung aus dem Wordpress Blog', 'izioseo') ?></li>
								<li><b>%category%</b> - <?php _e('Beschreibung der aktuellen Kategorie', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?php echo _e('META-Robots', 'izioseo') ?></h3>
		<p><?php _e('Die allgemeinen Einstellungen der Robots als Standardwert f&uuml;r alle Bereiche des Blogs.', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php echo $this->helpButton('META-Robots') ?> <label for="izioseo_robots_home"><?php _e('Startseite', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_home]" id="izioseo_robots_home">
							<?php foreach ($robots as $robot) : ?>
								<option value="<?php echo $robot ?>"<?php if ($data['izioseo_robots_home'] == $robot) : ?> selected<?php endif; ?>><?php echo $robot ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('META-Robots') ?> <label for="izioseo_robots_post"><?php _e('Blogbeitrag', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_post]" id="izioseo_robots_post">
							<?php foreach ($robots as $robot) : ?>
								<option value="<?php echo $robot ?>"<?php if ($data['izioseo_robots_post'] == $robot) : ?> selected<?php endif; ?>><?php echo $robot ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('META-Robots') ?> <label for="izioseo_robots_page"><?php _e('Statische Seiten', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_page]" id="izioseo_robots_page">
							<?php foreach ($robots as $robot) : ?>
								<option value="<?php echo $robot ?>"<?php if ($data['izioseo_robots_page'] == $robot) : ?> selected<?php endif; ?>><?php echo $robot ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('META-Robots') ?> <label for="izioseo_robots_search"><?php _e('Suchergebnisse', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_search]" id="izioseo_robots_search">
							<?php foreach ($robots as $robot) : ?>
								<option value="<?php echo $robot ?>"<?php if ($data['izioseo_robots_search'] == $robot) : ?> selected<?php endif; ?>><?php echo $robot ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('META-Robots') ?> <label for="izioseo_robots_category"><?php _e('Kategorie', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_category]" id="izioseo_robots_category">
							<?php foreach ($robots as $robot) : ?>
								<option value="<?php echo $robot ?>"<?php if ($data['izioseo_robots_category'] == $robot) : ?> selected<?php endif; ?>><?php echo $robot ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('META-Robots') ?> <label for="izioseo_robots_tag"><?php _e('Tag', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_tag]" id="izioseo_robots_tag">
							<?php foreach ($robots as $robot) : ?>
								<option value="<?php echo $robot ?>"<?php if ($data['izioseo_robots_tag'] == $robot) : ?> selected<?php endif; ?>><?php echo $robot ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('META-Robots') ?> <label for="izioseo_robots_archive"><?php _e('Archiv', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_archive]" id="izioseo_robots_archive">
							<?php foreach ($robots as $robot) : ?>
								<option value="<?php echo $robot ?>"<?php if ($data['izioseo_robots_archive'] == $robot) : ?> selected<?php endif; ?>><?php echo $robot ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('META-Robots') ?> <label for="izioseo_robots_404"><?php _e('404-Fehlerseite', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_robots_404]" id="izioseo_robots_404">
							<?php foreach ($robots as $robot) : ?>
								<option value="<?php echo $robot ?>"<?php if ($data['izioseo_robots_404'] == $robot) : ?> selected<?php endif; ?>><?php echo $robot ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?php echo _e('Bilder Suchmaschinenfreundlich optimieren', 'izioseo') ?></h3>
		<p><?php _e('Durch die folgenden Funktionen bestimmen Sie, ob die Bilder konform mit alt-Attribut und suchmaschinenfreundlicher Bezeichnung versehen werden sollen.', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Suchmaschinenfreundliche Bilder') ?> <label for="izioseo_image_use"><?php _e('Bilder optimieren', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_image_use]" id="izioseo_image_use"<?php if ($data['izioseo_image_use'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Sollen &lt;img ... /&gt; - Tags in Artikeln und Seiten suchmaschinenoptimiert dargestellt werden. Diese Funktion kann separat f&uuml;r jeden Artikel und jede Seite deaktiviert werden.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Suchmaschinenfreundliche Bilder') ?> <label for="izioseo_image_alt"><?php _e('Formatierung des alt-Attributes', 'izioseo') ?></label></th>
					<td>
						<input type="text" name="izioseo[izioseo_image_alt]" id="izioseo_image_alt" class="regular-text" value="<?php echo $data['izioseo_image_alt'] ?>" />
						<div style="text-align:justify;">
							<?php _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_image_alt')" id="link_izioseo_image_alt"><?php _e('anzeigen', 'izioseo') ?></a>
							<ul id="placeholder_izioseo_image_alt" style="margin:5px 12px; list-style-image: none; list-style-type: none; display:none;">
								<li><b>%blog_title%</b> - <?php _e('Titel des gesamten Blogs', 'izioseo') ?></li>
								<li><b>%post_title%</b> - <?php _e('Titel des Blogbeitrages', 'izioseo') ?></li>
								<li><b>%post_author_login%</b> - <?php _e('Loginname des Autors', 'izioseo') ?></li>
								<li><b>%post_author_nicename%</b> - <?php _e('Benutzername des Autors', 'izioseo') ?></li>
								<li><b>%post_author_firstname%</b> - <?php _e('Vorname des Autors', 'izioseo') ?></li>
								<li><b>%post_author_lastname%</b> - <?php _e('Nachname des Autors', 'izioseo') ?></li>
								<li><b>%category_title%</b> - <?php _e('Name der Kategorie', 'izioseo') ?></li>
								<li><b>%image_title%</b> - <?php _e('Titel des Bildes', 'izioseo') ?></li>
							</ul>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?php echo _e('Links auf rel="nofollow" setzen', 'izioseo') ?></h3>
		<p><?php _e('Setzen Sie verschiedene Funktionen ihres Blogs auf rel="nofollow".', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Links mit rel="nofollow"') ?> <label for="izioseo_nofollow_categories"><?php _e('Kategorieliste', 'izioseo') ?></label></th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_nofollow_categories]" id="izioseo_nofollow_categories"<?php if ($data['izioseo_nofollow_categories'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('In der Liste der Kategorien werden alle Links auf rel="nofollow" gesetzt. Sowie die Liste der Kategorien f&uuml;r einen Blogbeitrag.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Links mit rel="nofollow"') ?> <label for="izioseo_nofollow_bookmarks"><?php _e('Blogroll', 'izioseo') ?></label>
					</th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_nofollow_bookmarks]" id="izioseo_nofollow_bookmarks"<?php if ($data['izioseo_nofollow_bookmarks'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Setzt die Blogroll komplett auf rel="nofollow".', 'izioseo'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Links mit rel="nofollow"') ?> <label for="izioseo_nofollow_bookmarks"><?php _e('Tagcloud', 'izioseo') ?></label>
					</th>
					<td>
						<input type="checkbox" name="izioseo[izioseo_nofollow_tags]" id="izioseo_nofollow_tags"<?php if ($data['izioseo_nofollow_tags'] == 'on') : ?> checked<?php endif; ?> />
						<div style="text-align:justify;">
							<?php _e('Alle Tags der Tagcloud werden auf rel="nofollow" gesetzt.', 'izioseo'); ?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<h3><?php echo _e('Externe Links anonymisieren', 'izioseo') ?></h3>
		<p><?php _e('Mit diesen Links k&ouml;nnen Sie alle externen Links inidividuell anonymisieren. Dies ist vorallem f&uuml; Partnerprogramme interessant.', 'izioseo') ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Links anonymisieren') ?> <label for="izioseo_anonym_content_link"><?php _e('ContentLinks anonymisieren', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_anonym_content_link]" id="izioseo_anonym_content_link">
							<?php foreach ($anonym as $key => $value) : ?>
								<option value="<?php echo $key ?>"<?php if ($data['izioseo_anonym_content_link'] == $key) : ?> selected<?php endif; ?>><?php echo $value ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Links anonymisieren') ?> <label for="izioseo_anonym_comment_link"><?php _e('Kommentarlinks anonymisieren', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_anonym_comment_link]" id="izioseo_anonym_comment_link">
							<?php foreach ($anonym as $key => $value) : ?>
								<option value="<?php echo $key ?>"<?php if ($data['izioseo_anonym_comment_link'] == $key) : ?> selected<?php endif; ?>><?php echo $value ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo $this->helpButton('Links anonymisieren') ?> <label for="izioseo_anonym_bookmark_link"><?php _e('Links in der Blogroll anonymisieren', 'izioseo') ?></label></th>
					<td>
						<select name="izioseo[izioseo_anonym_bookmark_link]" id="izioseo_anonym_bookmark_link">
							<?php foreach ($anonym as $key => $value) : ?>
								<option value="<?php echo $key ?>"<?php if ($data['izioseo_anonym_bookmark_link'] == $key) : ?> selected<?php endif; ?>><?php echo $value ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Einstellungen speichern', 'izioseo')?>" />
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
			a.innerHTML = '<?php echo __('verbergen', 'izioseo') ?>';
			d.style.display = 'block';
		}
		else
		{
			a.innerHTML = '<?php echo __('anzeigen', 'izioseo') ?>';
			d.style.display = 'none';
		}
	}

//-->
</script>

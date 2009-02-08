<div id="normal-sortables" class="meta-box-sortables ui-sortable" style="position: relative;">
	<div id="izioseodiv" class="postbox">
		<div class="handlediv" title="Klicken zum Umschalten"><br /></div>
		<h3 class="hndle"><span><?php _e('izioSEO METAs', 'izioseo') ?></span></h3>
		<div class="inside">
			<div id="postcustomstuff">
				<table id="list-table">
					<thead>
						<tr>
							<th class="left"><?php _e('Name') ?></th>
							<th><?php _e('Value') ?></th>
						</tr>
					</thead>
					<tbody class="list:meta" id="the-list">
						<tr class="alternate">
							<td class="left" style="padding:2px 8px;"><label for="izioseo_post_disable"><?php echo $this->helpButton('META-Daten verwenden') ?> <?php _e('META-Tags benutzen:', 'izioseo')?></label></td>
							<td><input type="checkbox" name="izioseo[izioseo_post_disable]" onclick="javascript:disableMeta();" id="izioseo_post_disable"<?php if ($data['disable'] == 'off' || !strlen(trim($data['disable']))) : ?> checked<?php endif; ?> style="width:13px;" /></td>
						</tr>
						<tr class="alternate">
							<td class="left" style="padding:2px 8px;"><label for="izioseo_post_title"><?php echo $this->helpButton('Seitentitel') ?> <?php _e('Seitentitel:', 'izioseo') ?></label></td>
							<td><input type="text" name="izioseo[izioseo_post_title]" id="izioseo_post_title" value="<?php echo $data['title'] ?>" /></td>
						</tr>
						<tr class="alternate">
							<td class="left" style="padding:2px 8px;"><label for="izioseo_post_description"><?php echo $this->helpButton('META-Beschreibung') ?> <?php _e('META-Beschreibung:', 'izioseo') ?></label></td>
							<td><textarea name="izioseo[izioseo_post_description]" id="izioseo_post_description" style="height:100px;"><?php echo $data['description'] ?></textarea></td>
						</tr>
						<tr class="alternate">
							<td class="left" style="padding:2px 8px;"><label for="izioseo_post_keywords"><?php echo $this->helpButton('META-Keywords') ?> <?php _e('META-Keywords:<br />(durch Kommas getrennt)', 'izioseo') ?></label></td>
							<td><input type="text" name="izioseo[izioseo_post_keywords]" id="izioseo_post_keywords" value="<?php echo $data['keywords'] ?>" /></td>
						</tr>
						<tr class="alternate">
							<td class="left" style="padding:2px 8px;"><label for="izioseo_post_robots"><?php echo $this->helpButton('META-Robots') ?> <?php _e('META-Robots:', 'izioseo') ?></label></td>
							<td>
								<select name="izioseo[izioseo_post_robots]" id="izioseo_post_robots">
									<?php foreach ($select as $option) : ?>
										<option value="<?php echo $option ?>"<?php if ($data['robots'] == $option) : ?> selected<?php endif; ?>><?php echo $option ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr class="alternate">
							<td class="left" style="padding:2px 8px;"><?php echo $this->helpButton('Verhalten bei keinen META-Daten') ?> <label for="izioseo_post_use"><?php _e('Verwendung:<br />(bei keinen META-Daten)', 'izioseo') ?></label></td>
							<td>
								<select name="izioseo[izioseo_post_use]" id="izioseo_post_use">
									<?php foreach ($use as $value => $option) : ?>
										<option value="<?php echo $value ?>"<?php if ($data['use'] == $value) : ?> selected<?php endif; ?>><?php echo $option ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<p><?php _e('Weitere Einstellungsm&ouml;glichkeiten:', 'izioseo') ?></p>
				<table id="list-table">
					<thead>
						<tr>
							<th class="left"><?php _e('Name') ?></th>
							<th><?php _e('Value') ?></th>
						</tr>
					</thead>
					<tbody class="list:meta" id="the-list">
						<tr class="alternate">
							<td class="left" style="padding:2px 8px;"><?php echo $this->helpButton('Google AdSection') ?> <label for="izioseo_post_google_adsection"><?php _e('Google AdSection verwenden:', 'izioseo')?></label></td>
							<td><input type="checkbox" name="izioseo[izioseo_post_google_adsection]" id="izioseo_post_google_adsection"<?php if ($data['adsection'] == 'on') : ?> checked<?php endif; ?> style="width:13px;" /></td>
						</tr>
						<tr class="alternate">
							<td class="left" style="padding:2px 8px;"><?php echo $this->helpButton('Suchmaschinenfreundliche Bilder') ?> <label for="izioseo_post_image_use"><?php _e('Bilder optimieren:', 'izioseo')?></label></td>
							<td><input type="checkbox" name="izioseo[izioseo_post_image_use]" onclick="javascript:disableImage();" id="izioseo_post_image_use"<?php if ($data['seo_image_use'] == 'on') : ?> checked<?php endif; ?> style="width:13px;" /></td>
						</tr>
						<tr class="alternate">
							<td class="left" style="padding:2px 8px; vertical-align:top;"><?php echo $this->helpButton('Suchmaschinenfreundliche Bilder') ?> <label for="izioseo_post_image_alt"><?php _e('Formatierung des &lt;img ... alt="..." /&gt;-Tags', 'izioseo')?></label></td>
							<td>
								<input type="text" name="izioseo[izioseo_post_image_alt]" id="izioseo_post_image_alt" value="<?php echo $data['seo_image_alt'] ?>" />
								<div style="padding:0px 0px 8px 8px;">
									<?php _e('Zu verwendende Platzhalter', 'izioseo') ?> <a href="javascript:void(0);" onclick="javascript:toggleDisplay('izioseo_post_image_use')" id="link_izioseo_post_image_use"><?php _e('anzeigen', 'izioseo') ?></a>
									<ul id="placeholder_izioseo_post_image_use" style="list-style-image: none; list-style-type: none; display:none; padding-top:12px;">
										<li><b>%blog_title%</b> - <?php _e('Titel des gesamten Blogs', 'izioseo') ?></li>
										<li><b>%post_title%</b> - <?php _e('Titel des Blogbeitrages', 'izioseo') ?></li>
										<li><b>%post_author%</b> - <?php _e('Name des Autors', 'izioseo') ?></li>
										<li><b>%category_title%</b> - <?php _e('Name der Kategorie', 'izioseo') ?></li>
										<li><b>%image_title%</b> - <?php _e('Titel des Bildes', 'izioseo') ?></li>
									</ul>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
<!--

	disableImage();
	function disableImage()
	{
		if (document.getElementById('izioseo_post_image_use').checked == true)
		{
			document.getElementById('izioseo_post_image_alt').disabled = false;
		}
		else
		{
			document.getElementById('izioseo_post_image_alt').disabled = true;
		}
	}

	disableMeta();
	function disableMeta()
	{
		if (document.getElementById('izioseo_post_disable').checked == true)
		{
			document.getElementById('izioseo_post_title').disabled = false;
			document.getElementById('izioseo_post_description').disabled = false;
			document.getElementById('izioseo_post_keywords').disabled = false;
			document.getElementById('izioseo_post_robots').disabled = false;
			document.getElementById('izioseo_post_use').disabled = false;
		}
		else
		{
			document.getElementById('izioseo_post_title').disabled = true;
			document.getElementById('izioseo_post_description').disabled = true;
			document.getElementById('izioseo_post_keywords').disabled = true;
			document.getElementById('izioseo_post_robots').disabled = true;
			document.getElementById('izioseo_post_use').disabled = true;
		}
	}

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
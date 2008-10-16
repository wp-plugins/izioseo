<? if (substr($wpVersion, 0, 3) >= '2.5') : ?>
	<div id="postaiosp" class="postbox closed">
		<h3><?= _e('izioSEO METAs', 'izioseo') ?></h3>
		<div class="inside">
			<div id="post">
<? else : ?>
	<div class="dbx-b-ox-wrapper">
		<fieldset id="seodiv" class="dbx-box">
			<div class="dbx-h-andle-wrapper">
				<h3 class="dbx-handle"><?= _e('izioSEO METAs', 'izioseo') ?></h3>
			</div>
			<div class="dbx-c-ontent-wrapper">
				<div class="dbx-content">
<? endif; ?>

<table style="margin-bottom:40px">
	<tr>
		<th style="text-align:left;" colspan="2">&nbsp;</th>
	</tr>
	<tr>
		<th scope="row" style="text-align: left; vertical-align:top;"><label for="izioseo_post_disable"><?= _e('META-Tags benutzen:', 'izioseo')?></label></th>
		<td>
			<input type="checkbox" name="izioseo[izioseo_post_disable]" id="izioseo_post_disable"<? if ($data['disable'] == 'off' || !strlen(trim($data['disable']))) : ?> checked<? endif; ?> />
		</td>
	</tr>
	<tr>
		<th scope="row" style="text-align: left;"><label for="izioseo_post_title"><?= _e('Seitentitel', 'izioseo') ?></label></th>
		<td>
			<input type="text" name="izioseo[izioseo_post_title]" id="izioseo_post_title" style="width:450px;" value="<?= $data['title'] ?>" />
		</td>
	</tr>
	<tr>
		<th scope="row" style="text-align: left;"><label for="izioseo_post_description"><?= _e('META-Beschreibung:', 'izioseo') ?></label></th>
		<td>
			<textarea name="izioseo[izioseo_post_description]" id="izioseo_post_description" style="width:450px; height:100px;"><?= $data['description'] ?></textarea>
		</td>
	</tr>
	<tr>
		<th scope="row" style="text-align: left;"><label for="izioseo_post_keywords"><?= _e('META-Keywords:<br />(durch Kommas getrennt)', 'izioseo') ?></label></th>
		<td>
			<input type="text" name="izioseo[izioseo_post_keywords]" id="izioseo_post_keywords" style="width:450px;" value="<?= $data['keywords'] ?>" />
		</td>
	</tr>
	<tr>
		<th scope="row" style="text-align: left"><label for="izioseo_post_robots"><?= _e('META-Robots:', 'izioseo') ?></label></th>
		<td>
			<select name="izioseo[izioseo_post_robots]" id="izioseo_post_robots" style="width:460px;">
			<? foreach ($select as $option) : ?>
				<option value="<?= $option ?>"<? if ($data['robots'] == $option) : ?> selected<? endif; ?>><?= $option ?></option>
			<? endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
		<th scope="row" style="text-align: left;"><label for="izioseo_post_use"><?= _e('Verwendung:<br />(bei keinen META-Daten)', 'izioseo') ?></label></th>
		<td>
			<select name="izioseo[izioseo_post_use]" id="izioseo_post_use" style="width:460px;">
			<? foreach ($use as $value => $option) : ?>
				<option value="<?= $value ?>"<? if ($data['use'] == $value) : ?> selected<? endif; ?>><?= $option ?></option>
			<? endforeach; ?>
			</select>
		</td>
	</tr>
</table>
<? if (substr($wpVersion, 0, 3) >= '2.5') : ?>
			</div>
		</div>
	</div>
<? else : ?>
			</div>
		</fieldset>
	</div>
<? endif; ?>

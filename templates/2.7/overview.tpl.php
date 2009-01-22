<div class="wrap">
	<div class="icon32" style="background:transparent url(<?= $this->images ?>/izioseo-dashboard.png) no-repeat;"><br /></div>
	<h2><? _e('izioSEO Wordpress SEO Plugin', 'izioseo') ?></h2>
	<div>
		<div class="metabox-holder">
			<div class="inner-sidebar">
				<div class="meta-box-sortables ui-sortable" style="position: relative;">
					<? if (count($messages)) : ?>
						<div class="postbox">
							<h3><? _e('Fehler/Hinweis', 'izioseo') ?></h3>
							<div class="inside">
								<p style="margin:12px; text-align:justify;"><?= $this->helpButton('Fehlermeldungen') ?> <? _e('Es traten Fehler beim Aufruf von Wordpress auf. Verwenden Sie die folgende Liste, um die Fehler zu lokalisieren:', 'izioseo') ?></p>
								<ul style="margin:12px;">
									<? foreach($messages as $message) : ?>
										<?
											switch($message['type'])
											{
												case 'error':
													$color = '#f00';
													break;
												case 'attention':
													$color = '#21759b';
													break;
												case 'warning':
													$color = '#ff6600';
													break;
												default:
													$color = '#000';
											}
										?>
										<li style="color:<?= $color ?>; font-size:10px;"><strong><?= date('d.m.Y, H:i:s', $message['timestamp']) ?></strong> <?= $message['msg'] ?></li>
									<? endforeach; ?>
								</ul>
								<p style="clear:both;"></p>
							</div>
						</div>
					<? endif; ?>
					<div class="postbox">
						<h3><? _e('Linkdiagnosis', 'izioseo') ?></h3>
						<div class="inside">
							<p style="float:left; width:40%; text-align:center;"><img src="<?= $this->images ?>/linkdiagnosis.jpg" alt="Link Diagnosis - examine your link competition" height="90" width="90" /></p>
							<p style="float:left; width:55%; text-align:justify;">
								<? _e('Pr&uuml;fen Sie ihre Backlinks mit dem Backlinkchecker von <a href="http://www.linkdiagnosis.com/">linkdiagnosis.com</a>.'); ?><br /><br />
								<a class="button rbutton" class="thickbox" href="http://www.linkdiagnosis.com/?q=<?= get_option('siteurl', true) ?>"><? _e('Backlinks checken', 'izioseo') ?></a>
							</p>
							<p style="clear:both;"></p>
						</div>
					</div>
					<div class="postbox">
						<h3><? _e('Ranking', 'izioseo') ?></h3>
						<div class="inside">
							<p style="margin:12px; text-align:justify;"><? _e('Hier finden Sie einige Werte zum Ranking ihres Blogs in verschiedenen Diensten.', 'izioseo') ?></p>
							<div style="clear:both; margin:12px; text-align:justify;">
								<table style="width:100%;">
									<tr>
										<td style="margin-right: 12px;"><? _e('Google PageRank', 'izioseo') ?></td>
										<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?= $pr->GetPR(get_option('siteurl'), true) ?></td>
									</tr>
									<tr>
										<td style="margin-right: 12px;"><? _e('AlexaRank', 'izioseo') ?></td>
										<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?= $this->getAlexaRank() ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="postbox">
						<h3><? _e('Schnellhilfe', 'izioseo') ?></h3>
						<div class="inside">
							<form method="post" action="<?= $this->website ?>">
								<p style="margin:12px; text-align:justify;"><? _e('Sie wollen mehr &uuml;ber eine Funktion von izioSEO wissen. &Uuml;ber das Eingabefeld durchsuchen Sie die Dokumentation nach relevanten Themen.', 'izioseo') ?></p>
								<p style="text-align:center; width:100%;">
									<input type="text" name="s" onblur="if (this.value == '') this.value='<? _e('Suchbegriff', 'izioseo') ?>';" onfocus="if (this.value == '<? _e('Suchbegriff', 'izioseo') ?>') this.value='';" value="<? _e('Suchbegriff', 'izioseo') ?>" />
									<input class="button-primary" type="submit" value="<? _e('Suchen', 'izioseo') ?>" />
								</p>
								<p style="clear:both;"></p>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="has-sidebar">
				<div class="has-sidebar-content">
					<div class="meta-box-sortables ui-sortable" style="position: relative;">
						<div class="postbox">
							<h3><? _e('&Uuml;bersicht', 'izioseo') ?></h3>
							<div class="inside">
								<p style="margin:12px; text-align:justify;">
									<? printf(__('Das Wordpress SEO Plugin izioSEO ist ein vollautomatisches Plugin zur OnPage-Suchmaschinenoptimierung. Sie benutzen <a href="http://www.goizio.com/">izioSEO Version %s</a> mit <a href="http://www.wordpres.org/">Wordpress Version %s</a>.', 'izioseo'), $this->version, $this->wpVersion) ?>
									<? $this->newVersion() ?>
								</p>
								<p style="clear:both;"></p>
							</div>
						</div>
						<div class="postbox">
							<h3><? _e('Spenden', 'izioseo') ?></h3>
							<div class="inside">
								<p style="float:left; width:20%; text-align:center;">
									<input name="cmd" value="_donations" type="hidden">
									<input name="business" value="united20@united20.de" type="hidden">
									<input name="item_name" value="goizio.com Softwareprodukte" type="hidden">
									<input name="no_shipping" value="0" type="hidden">
									<input name="no_note" value="1" type="hidden">
									<input name="currency_code" value="EUR" type="hidden">
									<input name="tax" value="0" type="hidden">
									<input name="lc" value="DE" type="hidden">
									<input name="bn" value="PP-DonationsBF" type="hidden">
									<? if (@file_get_contents('http://www.paypal.com/de_DE/DE/i/logo/paypal_logo.gif')) : ?>
										<input alt="<? _e('Jetzt einfach, schnell und sicher online bezahlen mit PayPal.', 'izioseo') ?>" name="submit" src="https://www.paypal.com/de_DE/DE/i/btn/x-click-butcc-donate.gif" type="image" />
									<? else : ?>
										<input name="submit" class="button-primary" type="submit" style="margin-top:24px;" value="<? _e('Jetzt spenden', 'izioseo') ?>" />
									<? endif; ?>
									<img src="https://www.paypal.com/de_DE/i/scr/pixel.gif" alt="" width="1" border="0" height="1"><br>
								</p>
								<p style="float:left; width:75%; text-align:justify;"><? _e('Sie finden izioSEO super gelungen und m&ouml;chten helfen weitere Features und Funktionen f&uuml;r dieses Wordpress Plugin umzusetzen. Dann <a href="http://www.goizio.com/kontakt/">sagen</a> Sie uns ihre W&uuml;nsche und Vorschl&auml;ge f&uuml;r izioSEO. Und spenden Sie uns den Betrag, wie Sie meinen, was izioSEO Ihnen wert ist!'); ?></p>
								<p style="clear:both;"></p>
							</div>
						</div>
						<? if (is_array($rss->items) && count($rss->items)) : ?>
							<div class="postbox">
								<h3><? _e('News', 'izioseo') ?></h3>
								<div class="inside">
									<ul style="margin:12px; clear:both; text-align:justify;">
										<? foreach ($rss->items as $post) : ?>
											<li>
												<a href="<?= $post['link'] ?>" class="rsswidget"><?= $post['title'] ?></a>
												<span class="rss-date"><?= date(get_option('date_format', true), strtotime($post['pubdate'])) ?></span>
												<div class="rssSummary"><? if (strlen(trim($post['summary']))) : ?><?= $this->truncate($post['summary'], 180) ?><? else : ?><?= $this->truncate($post['description'], 180) ?><? endif; ?></div>
											</li>
										<? endforeach; ?>
									</ul>
								</div>
							</div>
						<? endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
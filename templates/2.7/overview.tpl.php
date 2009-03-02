<div class="wrap">
	<div class="icon32" style="background:transparent url(<?php echo $this->images ?>/izioseo-dashboard.png) no-repeat;"><br /></div>
	<h2><?php _e('izioSEO Wordpress SEO Plugin', 'izioseo') ?></h2>
	<div>
		<div class="metabox-holder">
			<div class="inner-sidebar">
				<div class="meta-box-sortables ui-sortable" style="position: relative;">
					<div class="postbox">
						<h3><?php _e('Linkdiagnosis', 'izioseo') ?></h3>
						<div class="inside">
							<p style="float:left; width:40%; text-align:center;"><img src="<?php echo $this->images ?>/linkdiagnosis.jpg" alt="Link Diagnosis - examine your link competition" height="90" width="90" /></p>
							<p style="float:left; width:55%; text-align:justify;">
								<?php _e('Pr&uuml;fen Sie ihre Backlinks mit dem Backlinkchecker von <a href="http://www.linkdiagnosis.com/">linkdiagnosis.com</a>.'); ?><br /><br />
								<a class="button rbutton" class="thickbox" href="http://www.linkdiagnosis.com/?q=<?php echo get_option('siteurl', true) ?>"><?php _e('Backlinks checken', 'izioseo') ?></a>
							</p>
							<p style="clear:both;"></p>
						</div>
					</div>
					<div class="postbox">
						<h3><?php _e('Ranking', 'izioseo') ?></h3>
						<div class="inside">
							<p style="margin:12px; text-align:justify;"><?php _e('Hier finden Sie einige Werte zum Ranking ihres Blogs in verschiedenen Diensten.', 'izioseo') ?></p>
							<div style="clear:both; margin:12px; text-align:justify;">
								<table style="width:100%;">
									<tr>
										<td style="margin-right: 12px;"><?php _e('Google PageRank', 'izioseo') ?></td>
										<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?php echo $pr->GetPR(get_option('siteurl'), true) ?></td>
									</tr>
									<tr>
										<td style="margin-right: 12px;"><?php _e('AlexaRank', 'izioseo') ?></td>
										<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?php echo $this->alexaRank() ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="has-sidebar">
				<div class="has-sidebar-content">
					<div class="meta-box-sortables ui-sortable" style="position: relative;">
						<div class="postbox">
							<h3><?php _e('&Uuml;bersicht', 'izioseo') ?></h3>
							<div class="inside">
								<p style="margin:12px; text-align:justify;">
									<?php printf(__('Das Wordpress SEO Plugin izioSEO ist ein vollautomatisches Plugin zur OnPage-Suchmaschinenoptimierung. Sie benutzen <a href="http://www.goizio.com/">izioSEO Version %s</a> mit <a href="http://www.wordpres.org/">Wordpress Version %s</a>.', 'izioseo'), $this->version, $this->wpv) ?>
									<?php $this->newVersion() ?>
								</p>
								<p style="clear:both;"></p>
							</div>
						</div>
						<div class="postbox">
							<h3><?php _e('Spenden', 'izioseo') ?></h3>
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
									<?php if (@file_get_contents('http://www.paypal.com/de_DE/DE/i/logo/paypal_logo.gif')) : ?>
										<input alt="<?php _e('Jetzt einfach, schnell und sicher online bezahlen mit PayPal.', 'izioseo') ?>" name="submit" src="https://www.paypal.com/de_DE/DE/i/btn/x-click-butcc-donate.gif" type="image" />
									<?php else : ?>
										<input name="submit" class="button-primary" type="submit" style="margin-top:24px;" value="<?php _e('Jetzt spenden', 'izioseo') ?>" />
									<?php endif; ?>
									<img src="https://www.paypal.com/de_DE/i/scr/pixel.gif" alt="" width="1" border="0" height="1"><br>
								</p>
								<p style="float:left; width:75%; text-align:justify;"><?php _e('Sie finden izioSEO super gelungen und m&ouml;chten helfen weitere Features und Funktionen f&uuml;r dieses Wordpress Plugin umzusetzen. Dann <a href="http://www.goizio.com/kontakt/">sagen</a> Sie uns ihre W&uuml;nsche und Vorschl&auml;ge f&uuml;r izioSEO. Und spenden Sie uns den Betrag, wie Sie meinen, was izioSEO Ihnen wert ist!'); ?></p>
								<p style="clear:both;"></p>
							</div>
						</div>
						<?php if (is_array($rss->items) && count($rss->items)) : ?>
							<div class="postbox">
								<h3><?php _e('News', 'izioseo') ?></h3>
								<div class="inside">
									<ul style="margin:12px; clear:both; text-align:justify;">
										<?php foreach ($rss->items as $post) : ?>
											<li>
												<a href="<?php echo $post['link'] ?>" class="rsswidget"><?php echo $post['title'] ?></a>
												<span class="rss-date"><?php echo date(get_option('date_format', true), strtotime($post['pubdate'])) ?></span>
												<div class="rssSummary"><?php if (strlen(trim($post['summary']))) : ?><?php echo $this->truncate($post['summary'], 180) ?><?php else : ?><?php echo $this->truncate($post['description'], 180) ?><?php endif; ?></div>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
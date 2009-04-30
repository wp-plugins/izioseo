<div class="wrap">
	<h2><?php _e('izioSEO Wordpress SEO Plugin', 'izioseo') ?></h2>
	<div id="rightnow">
		<h3 class="reallynow">
			<span><?php _e('&Uuml;bersicht', 'izioseo') ?></span>
			<br class="clear"/>
		</h3>
		<p class="youhave">
			<?php printf(__('Das Wordpress SEO Plugin izioSEO ist ein vollautomatisches Plugin zur OnPage-Suchmaschinenoptimierung. Sie benutzen <a href="http://www.goizio.com/">izioSEO Version %s</a> mit <a href="http://www.wordpres.org/">Wordpress Version %s</a>.', 'izioseo'), $this->version, $this->wpv) ?>
		</p>
		<p class="youare">
			<p style="float:left; width:10%; text-align:center;">
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
					<input name="submit" class="button-primary" type="submit" style="margin-top:12px;" value="<?php _e('Jetzt spenden', 'izioseo') ?>" />
				<?php endif; ?>
				<img src="https://www.paypal.com/de_DE/i/scr/pixel.gif" alt="" width="1" border="0" height="1"><br />
			</p>
			<p style="float:left; width:85%; text-align:justify;"><?php _e('Sie finden izioSEO super gelungen und m&ouml;chten helfen weitere Features und Funktionen f&uuml;r dieses Wordpress Plugin umzusetzen. Dann <a href="http://www.goizio.com/kontakt/">sagen</a> Sie uns ihre W&uuml;nsche und Vorschl&auml;ge f&uuml;r izioSEO. Und spenden Sie uns den Betrag, wie Sie meinen, was izioSEO Ihnen wert ist!'); ?></p>
			<p style="clear:both;"></p>
		</p>
	</div>
	<br class="clear" />
</div>
<div id="dashboard-widgets-wrap" style="width:994px;">
	<div id="dashboard-widgets">
		<br class="clear" />
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:495px; margin:3px 0px 10px 16px;">
			<div class="dashboard-widget" style="height:165px;">
				<h3 class="dashboard-widget-title">
					<span><?php _e('Ranking', 'izioseo') ?></span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<p style="font-size:13px; text-align:justify;"><?php _e('Hier finden Sie einige Werte zum Ranking ihres Blogs in verschiedenen Diensten.', 'izioseo') ?></p>
					<div style="clear:both; text-align:justify;">
						<table style="width:100%;">
							<tr>
								<td style="font-size:13px; margin-right: 12px;"><?php _e('Google PageRank', 'izioseo') ?></td>
								<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?php echo $pr->GetPR(get_option('siteurl'), true) ?></td>
							</tr>
							<tr>
								<td style="font-size:13px; margin-right: 12px;"><?php _e('AlexaRank', 'izioseo') ?></td>
								<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?php echo $this->alexaRank() ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:475px; margin:3px 0px 10px 0px;">
			<div class="dashboard-widget" style="height:165px; margin-right:0px;">
				<h3 class="dashboard-widget-title">
					<span><?php _e('Linkdiagnosis', 'izioseo') ?></span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<p style="float:left; width:25%; text-align:center;"><img src="<?php echo $this->images ?>/linkdiagnosis.jpg" alt="Link Diagnosis - examine your link competition" height="90" width="90" /></p>
					<p style="float:left; font-size:13px; width:70%; text-align:justify;">
						<?php _e('Pr&uuml;fen Sie ihre Backlinks mit dem Backlinkchecker von <a href="http://www.linkdiagnosis.com/">linkdiagnosis.com</a>.'); ?><br /><br />
						<a class="button rbutton" class="thickbox" href="http://www.linkdiagnosis.com/?q=<?php echo get_option('siteurl', true) ?>"><?php _e('Backlinks checken', 'izioseo') ?></a>
					</p>
				</div>
			</div>
		</div>
		<br class="clear" />
		<?php if (is_array($rss->items) && count($rss->items)) : ?>
			<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:495px; margin:10px 0px 5px 16px;">
				<div class="dashboard-widget">
					<h3 class="dashboard-widget-title">
						<span><?php _e('News', 'izioseo') ?></span>
						<br class="clear">
					</h3>
					<div class="dashboard-widget-content">
						<ul>
							<?php foreach ($rss->items as $post) : ?>
								<li style="font-size:13px;">
									<a class="rsswidget" href="<?php echo $post['link'] ?>"><?php echo $post['title'] ?></a>
									<span class="rss-date"><?php echo date(get_option('date_format', true), strtotime($post['pubdate'])) ?></span>
									<div class="rssSummary"><?php if (strlen(trim($post['summary']))) : ?><?php echo $this->truncate($post['summary'], 180) ?><?php else : ?><?php echo $this->truncate($post['description'], 180) ?><?php endif; ?></div>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<br class="clear" />
</div>

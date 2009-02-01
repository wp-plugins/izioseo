<div class="wrap">
	<h2><?php _e('izioSEO Wordpress SEO Plugin › Statistik', 'izioseo') ?></h2>
	<br class="clear" />
</div>
<div id="dashboard-widgets-wrap" style="width:994px;">
	<div id="dashboard-widgets">
		<br class="clear" />
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:495px; margin:3px 0px 10px 16px;">
			<div class="dashboard-widget" style="height:175px;">
				<h3 class="dashboard-widget-title">
					<span><?php _e('Statistik', 'izioseo') ?></span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<table style="width:100%;">
						<tr>
							<td style="font-size:13px; margin-right: 12px;"><?php _e('Referers (gesamt)', 'izioseo') ?></td>
							<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?php echo $stats->numReferers() ?></td>
						</tr>
						<tr>
							<td style="font-size:13px; margin-right: 12px;"><?php _e('Referers (Suchanfragen)', 'izioseo') ?></td>
							<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?php echo $stats->numReferers('searchengines') ?></td>
						</tr>
						<tr>
							<td style="font-size:13px; margin-right: 12px;"><?php _e('Referers (andere)', 'izioseo') ?></td>
							<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?php echo $stats->numReferers('other') ?></td>
						</tr>
						<tr>
							<td style="font-size:13px; margin-right: 12px;"><?php _e('Keywords', 'izioseo') ?></td>
							<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?php echo $stats->numKeywords() ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:475px; margin:3px 0px 10px 0px;">
			<div class="dashboard-widget" style="height:175px; margin-right:0px;">
				<h3 class="dashboard-widget-title">
					<span><?php _e('Suchmaschinen', 'izioseo') ?></span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<div style="border:1px #e1e1e1 solid; text-align:center;">
						<?php open_flash_chart_object(437, 127, $_SERVER['REQUEST_URI'] . (!isset($_GET['flash']) ? '&flash' : ''), true, $pluginDir); ?>
					</div>
				</div>
			</div>
		</div>
		<br class="clear" />
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:495px; margin:3px 0px 10px 16px;">
			<div class="dashboard-widget" style="height:310px;">
				<h3 class="dashboard-widget-title">
					<span><?php _e('Suchanfragen', 'izioseo') ?> (<?php _e('Top', 'izioseo') ?> <?php echo $nr ?>)</span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<p style="font-size:13px;">
						<?php _e('Anzahl festlegen', 'izioseo') ?>
						<a href="<?php if (!isset($_GET['nr'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nr=10<?php else : ?><?php echo str_replace('nr=' . $nr, 'nr=' . 10, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">10</a> |
						<a href="<?php if (!isset($_GET['nr'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nr=20<?php else : ?><?php echo str_replace('nr=' . $nr, 'nr=' . 20, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">20</a> |
						<a href="<?php if (!isset($_GET['nr'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nr=50<?php else : ?><?php echo str_replace('nr=' . $nr, 'nr=' . 50, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">50</a> |
						<a href="<?php if (!isset($_GET['nr'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nr=100<?php else : ?><?php echo str_replace('nr=' . $nr, 'nr=' . 100, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">100</a><br />
						<?php _e('Suchanfragen downloaden als', 'izioseo') ?>
						<a href="<?php if (!isset($_GET['export'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;export=request-csv<?php else : ?><?php echo str_replace('export=' . $export, 'export=request-csv', $_SERVER['REQUEST_URI']) ?><?php endif; ?>"><?php _e('csv - Datei', 'izioseo') ?></a>
					</p>
					<table style="width:100%;">
						<?php foreach ($stats->getRequests($nr) as $key => $referer) : ?>
							<tr>
								<td style="width:18px;"><a href="<?php echo $referer['referer_url'] ?>"><img src="<?php echo $this->images ?>folder.png" alt="<?php _e('Suchanfrage aufrufen', 'izioseo') ?>" height="16" width="16" /></a></td>
								<td style="font-size:13px; margin-right: 12px;"><?php echo $this->truncate($referer['referer_request'], 45, 'h') ?></td>
								<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?php echo $referer['referer_count'] ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:475px; margin:3px 0px 10px 0px;">
			<div class="dashboard-widget" style="margin-right:0px; height:310px;">
				<h3 class="dashboard-widget-title">
					<span><?php _e('Verlinkende Websites', 'izioseo') ?> (<?php _e('Top', 'izioseo') ?> <?php echo $nref ?>)</span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<p style="font-size:13px;">
						<?php _e('Anzahl festlegen', 'izioseo') ?>
						<a href="<?php if (!isset($_GET['nref'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nref=10<?php else : ?><?php echo str_replace('nref=' . $nref, 'nref=' . 10, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">10</a> |
						<a href="<?php if (!isset($_GET['nref'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nref=20<?php else : ?><?php echo str_replace('nref=' . $nref, 'nref=' . 20, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">20</a> |
						<a href="<?php if (!isset($_GET['nref'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nref=50<?php else : ?><?php echo str_replace('nref=' . $nref, 'nref=' . 50, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">50</a> |
						<a href="<?php if (!isset($_GET['nref'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nref=100<?php else : ?><?php echo str_replace('nref=' . $nref, 'nref=' . 100, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">100</a><br />
						<?php _e('Verlinkende Seiten downloaden als', 'izioseo') ?>
						<a href="<?php if (!isset($_GET['export'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;export=referer-csv<?php else : ?><?php echo str_replace('export=' . $export, 'export=referer-csv', $_SERVER['REQUEST_URI']) ?><?php endif; ?>"><?php _e('csv - Datei', 'izioseo') ?></a>
					</p>
					<table style="width:100%;">
						<?php foreach ($stats->getReferers($nref) as $key => $referer) : ?>
							<tr>
								<td style="width:18px;"><a href="<?php echo $referer['referer_url'] ?>"><img src="<?php echo $this->images ?>folder.png" alt="<?php _e('Suchanfrage aufrufen', 'izioseo') ?>" height="16" width="16" /></a></td>
								<td style="font-size:13px; margin-right: 12px;"><?php echo $this->truncate($referer['referer_url'], 45, 'h') ?></td>
								<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?php echo $referer['referer_count'] ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<br class="clear" />
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:495px; margin:3px 0px 10px 16px;">
			<div class="dashboard-widget" style="height:310px;">
				<h3 class="dashboard-widget-title">
					<span><?php _e('Keywords', 'izioseo') ?> (<?php _e('Top', 'izioseo') ?> <?php echo $nk ?>)</span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<p style="font-size:13px;">
						<?php _e('Anzahl festlegen', 'izioseo') ?>
						<a href="<?php if (!isset($_GET['nk'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nk=10<?php else : ?><?php echo str_replace('nk=' . $nk, 'nk=' . 10, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">10</a> |
						<a href="<?php if (!isset($_GET['nk'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nk=20<?php else : ?><?php echo str_replace('nk=' . $nk, 'nk=' . 20, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">20</a> |
						<a href="<?php if (!isset($_GET['nk'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nk=50<?php else : ?><?php echo str_replace('nk=' . $nk, 'nk=' . 50, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">50</a> |
						<a href="<?php if (!isset($_GET['nk'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nk=100<?php else : ?><?php echo str_replace('nk=' . $nk, 'nk=' . 100, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">100</a><br />
						<?php _e('Keywords downloaden als', 'izioseo') ?>
						<a href="<?php if (!isset($_GET['export'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;export=keywords-csv<?php else : ?><?php echo str_replace('export=' . $export, 'export=keywords-csv', $_SERVER['REQUEST_URI']) ?><?php endif; ?>"><?php _e('csv - Datei', 'izioseo') ?></a>
					</p>
					<table style="width:100%;">
						<?php foreach ($stats->getKeywords($nk) as $key => $keyword) : ?>
							<tr>
								<td style="font-size:13px; margin-right: 12px;"><?php echo $keyword['referer_keyword'] ?></td>
								<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?php echo $keyword['keyword_count'] ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<br class="clear" />
	</div>
</div>

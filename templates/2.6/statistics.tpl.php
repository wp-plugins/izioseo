<div class="wrap">
	<h2><? _e('izioSEO Wordpress SEO Plugin › Statistik', 'izioseo') ?></h2>
	<br class="clear" />
</div>
<div id="dashboard-widgets-wrap" style="width:994px;">
	<div id="dashboard-widgets">
		<br class="clear" />
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:495px; margin:3px 0px 10px 16px;">
			<div class="dashboard-widget" style="height:165px;">
				<h3 class="dashboard-widget-title">
					<span><? _e('Statistik', 'izioseo') ?></span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<table style="width:100%;">
						<tr>
							<td style="font-size:13px; margin-right: 12px;"><? _e('Referers (gesamt)', 'izioseo') ?></td>
							<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?= $stats->numReferers() ?></td>
						</tr>
						<tr>
							<td style="font-size:13px; margin-right: 12px;"><? _e('Referers (Suchanfragen)', 'izioseo') ?></td>
							<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?= $stats->numReferers('searchengines') ?></td>
						</tr>
						<tr>
							<td style="font-size:13px; margin-right: 12px;"><? _e('Referers (andere)', 'izioseo') ?></td>
							<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?= $stats->numReferers('other') ?></td>
						</tr>
						<tr>
							<td style="font-size:13px; margin-right: 12px;"><? _e('Keywords', 'izioseo') ?></td>
							<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?= $stats->numKeywords() ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:475px; margin:3px 0px 10px 0px;">
			<div class="dashboard-widget" style="height:165px; margin-right:0px;">
				<h3 class="dashboard-widget-title">
					<span><? _e('Suchmaschinen', 'izioseo') ?></span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<div style="border:1px #e1e1e1 solid; text-align:center;">
						<? open_flash_chart_object(437, 115, $_SERVER['REQUEST_URI'] . (!isset($_GET['flash']) ? '&flash' : ''), true, $pluginDir); ?>
					</div>
				</div>
			</div>
		</div>
		<br class="clear" />
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:495px; margin:3px 0px 10px 16px;">
			<div class="dashboard-widget">
				<h3 class="dashboard-widget-title">
					<span><? _e('Suchanfragen', 'izioseo') ?> (<? _e('Top', 'izioseo') ?> <?= $nr ?>)</span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<p style="font-size:13px;">
						<? _e('Anzahl festlegen', 'izioseo') ?>
						<a href="<? if (!isset($_GET['nr'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nr=10<? else : ?><?= str_replace('nr=' . $nr, 'nr=' . 10, $_SERVER['REQUEST_URI']) ?><? endif; ?>">10</a> |
						<a href="<? if (!isset($_GET['nr'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nr=20<? else : ?><?= str_replace('nr=' . $nr, 'nr=' . 20, $_SERVER['REQUEST_URI']) ?><? endif; ?>">20</a> |
						<a href="<? if (!isset($_GET['nr'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nr=50<? else : ?><?= str_replace('nr=' . $nr, 'nr=' . 50, $_SERVER['REQUEST_URI']) ?><? endif; ?>">50</a> |
						<a href="<? if (!isset($_GET['nr'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nr=100<? else : ?><?= str_replace('nr=' . $nr, 'nr=' . 100, $_SERVER['REQUEST_URI']) ?><? endif; ?>">100</a><br />
						<? _e('Suchanfragen downloaden als', 'izioseo') ?>
						<a href="<? if (!isset($_GET['export'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;export=request-csv<? else : ?><?= str_replace('export=' . $export, 'export=request-csv', $_SERVER['REQUEST_URI']) ?><? endif; ?>"><? _e('csv - Datei', 'izioseo') ?></a>
					</p>
					<table style="width:100%;">
						<? foreach ($stats->getRequests($nr) as $key => $referer) : ?>
							<tr>
								<td style="width:18px;"><a href="<?= $referer['referer_url'] ?>"><img src="<?= $this->images ?>folder.png" alt="<? _e('Suchanfrage aufrufen', 'izioseo') ?>" height="16" width="16" /></a></td>
								<td style="font-size:13px; margin-right: 12px;"><?= $this->truncate($referer['referer_request'], 100) ?></td>
								<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?= $referer['referer_count'] ?></td>
							</tr>
						<? endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:475px; margin:3px 0px 10px 0px;">
			<div class="dashboard-widget" style="margin-right:0px;">
				<h3 class="dashboard-widget-title">
					<span><? _e('Verlinkende Websites', 'izioseo') ?> (<? _e('Top', 'izioseo') ?> <?= $nref ?>)</span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<p style="font-size:13px;">
						<? _e('Anzahl festlegen', 'izioseo') ?>
						<a href="<? if (!isset($_GET['nref'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nref=10<? else : ?><?= str_replace('nref=' . $nref, 'nref=' . 10, $_SERVER['REQUEST_URI']) ?><? endif; ?>">10</a> |
						<a href="<? if (!isset($_GET['nref'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nref=20<? else : ?><?= str_replace('nref=' . $nref, 'nref=' . 20, $_SERVER['REQUEST_URI']) ?><? endif; ?>">20</a> |
						<a href="<? if (!isset($_GET['nref'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nref=50<? else : ?><?= str_replace('nref=' . $nref, 'nref=' . 50, $_SERVER['REQUEST_URI']) ?><? endif; ?>">50</a> |
						<a href="<? if (!isset($_GET['nref'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nref=100<? else : ?><?= str_replace('nref=' . $nref, 'nref=' . 100, $_SERVER['REQUEST_URI']) ?><? endif; ?>">100</a><br />
						<? _e('Verlinkende Seiten downloaden als', 'izioseo') ?>
						<a href="<? if (!isset($_GET['export'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;export=referer-csv<? else : ?><?= str_replace('export=' . $export, 'export=referer-csv', $_SERVER['REQUEST_URI']) ?><? endif; ?>"><? _e('csv - Datei', 'izioseo') ?></a>
					</p>
					<table style="width:100%;">
						<? foreach ($stats->getReferers($nref) as $key => $referer) : ?>
							<tr>
								<td style="width:18px;"><a href="<?= $referer['referer_url'] ?>"><img src="<?= $this->images ?>folder.png" alt="<? _e('Suchanfrage aufrufen', 'izioseo') ?>" height="16" width="16" /></a></td>
								<td style="font-size:13px; margin-right: 12px;"><?= $this->truncate($referer['referer_url'], 100) ?></td>
								<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?= $referer['referer_count'] ?></td>
							</tr>
						<? endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<br class="clear" />
		<div class="dashboard-widget-holder widget_rss wp_dashboard_empty" style="width:495px; margin:3px 0px 10px 16px;">
			<div class="dashboard-widget">
				<h3 class="dashboard-widget-title">
					<span><? _e('Keywords', 'izioseo') ?> (<? _e('Top', 'izioseo') ?> <?= $nk ?>)</span>
					<br class="clear">
				</h3>
				<div class="dashboard-widget-content">
					<p style="font-size:13px;">
						<? _e('Anzahl festlegen', 'izioseo') ?>
						<a href="<? if (!isset($_GET['nk'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nk=10<? else : ?><?= str_replace('nk=' . $nk, 'nk=' . 10, $_SERVER['REQUEST_URI']) ?><? endif; ?>">10</a> |
						<a href="<? if (!isset($_GET['nk'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nk=20<? else : ?><?= str_replace('nk=' . $nk, 'nk=' . 20, $_SERVER['REQUEST_URI']) ?><? endif; ?>">20</a> |
						<a href="<? if (!isset($_GET['nk'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nk=50<? else : ?><?= str_replace('nk=' . $nk, 'nk=' . 50, $_SERVER['REQUEST_URI']) ?><? endif; ?>">50</a> |
						<a href="<? if (!isset($_GET['nk'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nk=100<? else : ?><?= str_replace('nk=' . $nk, 'nk=' . 100, $_SERVER['REQUEST_URI']) ?><? endif; ?>">100</a><br />
						<? _e('Keywords downloaden als', 'izioseo') ?>
						<a href="<? if (!isset($_GET['export'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;export=keywords-csv<? else : ?><?= str_replace('export=' . $export, 'export=keywords-csv', $_SERVER['REQUEST_URI']) ?><? endif; ?>"><? _e('csv - Datei', 'izioseo') ?></a>
					</p>
					<table style="width:100%;">
						<? foreach ($stats->getKeywords($nk) as $key => $keyword) : ?>
							<tr>
								<td style="font-size:13px; margin-right: 12px;"><?= $keyword['referer_keyword'] ?></td>
								<td style="color:#2583ad; font-size:13px; font-weight:bold; text-align:right;"><?= $keyword['keyword_count'] ?></td>
							</tr>
						<? endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<br class="clear" />
	</div>
</div>










<? /*<div class="wrap">
	<div class="icon32" style="background:transparent url(<?= $this->images ?>/izioseo-dashboard.png) no-repeat;"><br /></div>
	<h2><? _e('izioSEO Wordpress SEO Plugin › Statistik', 'izioseo') ?></h2>
	<div class="metabox-holder">
		<div class="inner-sidebar">
			<div class="meta-box-sortables ui-sortable" style="position: relative;">
				<div class="postbox">
					<h3><? _e('Keywords', 'izioseo') ?> (<? _e('Top', 'izioseo') ?> <?= $nk ?>)</h3>
					<div class="inside">
						<div style="clear:both; margin:12px; text-align:justify;">
							<p>
								<? _e('Anzahl festlegen', 'izioseo') ?>
								<a href="<? if (!isset($_GET['nk'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nk=10<? else : ?><?= str_replace('nk=' . $nk, 'nk=' . 10, $_SERVER['REQUEST_URI']) ?><? endif; ?>">10</a> |
								<a href="<? if (!isset($_GET['nk'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nk=20<? else : ?><?= str_replace('nk=' . $nk, 'nk=' . 20, $_SERVER['REQUEST_URI']) ?><? endif; ?>">20</a> |
								<a href="<? if (!isset($_GET['nk'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nk=50<? else : ?><?= str_replace('nk=' . $nk, 'nk=' . 50, $_SERVER['REQUEST_URI']) ?><? endif; ?>">50</a> |
								<a href="<? if (!isset($_GET['nk'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;nk=100<? else : ?><?= str_replace('nk=' . $nk, 'nk=' . 100, $_SERVER['REQUEST_URI']) ?><? endif; ?>">100</a><br />
								<? _e('Keywords downloaden als', 'izioseo') ?>
								<a href="<? if (!isset($_GET['export'])) : ?><?= $_SERVER['REQUEST_URI'] ?>&amp;export=keywords-csv<? else : ?><?= str_replace('export=' . $export, 'export=keywords-csv', $_SERVER['REQUEST_URI']) ?><? endif; ?>"><? _e('csv - Datei', 'izioseo') ?></a>
							</p>
							<table style="width:100%;">
								<? foreach ($stats->getKeywords($nk) as $key => $keyword) : ?>
									<tr>
										<td style="margin-right: 12px;"><?= $keyword['referer_keyword'] ?></td>
										<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?= $keyword['keyword_count'] ?></td>
									</tr>
								<? endforeach; ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div> */ ?>
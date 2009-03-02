<div class="wrap">
	<div class="icon32" style="background:transparent url(<?php echo $this->images ?>/izioseo-dashboard.png) no-repeat;"><br /></div>
	<h2><?php _e('izioSEO Wordpress SEO Plugin › Statistik', 'izioseo') ?></h2>
	<div class="metabox-holder">
		<div class="inner-sidebar">
			<div class="meta-box-sortables ui-sortable" style="position: relative;">
				<div class="postbox">
					<h3><?php _e('Statistik', 'izioseo') ?></h3>
					<div class="inside">
						<div style="clear:both; margin:12px; text-align:justify;">
							<table style="width:100%;">
								<tr>
									<td style="margin-right: 12px;"><?php _e('Referers (gesamt)', 'izioseo') ?></td>
									<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?php echo $stats->numReferers() ?></td>
								</tr>
								<tr>
									<td style="margin-right: 12px;"><?php _e('Referers (Suchanfragen)', 'izioseo') ?></td>
									<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?php echo $stats->numReferers('searchengines') ?></td>
								</tr>
								<tr>
									<td style="margin-right: 12px;"><?php _e('Referers (andere)', 'izioseo') ?></td>
									<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?php echo $stats->numReferers('other') ?></td>
								</tr>
								<tr>
									<td style="margin-right: 12px;"><?php _e('Keywords', 'izioseo') ?></td>
									<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?php echo $stats->numKeywords() ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="postbox">
					<h3><?php _e('Suchmaschinen', 'izioseo') ?></h3>
					<div class="inside">
						<div style="border:1px #e1e1e1 solid; margin:12px; text-align:center;">
							<?php open_flash_chart_object(250, 250, $_SERVER['REQUEST_URI'] . (!isset($_GET['flash']) ? '&flash' : ''), true, $pluginDir); ?>
						</div>
						<p style="clear:both;"></p>
					</div>
				</div>
				<div class="postbox">
					<h3><?php _e('Keywords', 'izioseo') ?> (<?php _e('Top', 'izioseo') ?> <?php echo $nk ?>)</h3>
					<div class="inside">
						<div style="clear:both; margin:12px; text-align:justify;">
							<p>
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
										<td style="margin-right: 12px;"><?php echo $keyword['referer_keyword'] ?></td>
										<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?php echo $keyword['keyword_count'] ?></td>
									</tr>
								<?php endforeach; ?>
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
						<h3><?php _e('Suchanfragen', 'izioseo') ?> (<?php _e('Top', 'izioseo') ?> <?php echo $nr ?>)</h3>
						<div class="inside">
							<div style="clear:both; margin:12px; text-align:justify;">
								<p>
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
											<td style="margin-right: 12px;"><?php echo $this->truncate($referer['referer_request'], 60, 'h') ?></td>
											<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?php echo $referer['referer_count'] ?></td>
										</tr>
									<?php endforeach; ?>
								</table>
							</div>
						</div>
					</div>
					<div class="postbox">
						<h3><?php _e('Verlinkende Websites', 'izioseo') ?> (<?php _e('Top', 'izioseo') ?> <?php echo $nref ?>)</h3>
						<div class="inside">
							<div style="clear:both; margin:12px; text-align:justify;">
								<p>
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
											<td style="margin-right: 12px;"><?php echo $this->truncate($referer['referer_url'], 60, 'h') ?></td>
											<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?php echo $referer['referer_count'] ?></td>
										</tr>
									<?php endforeach; ?>
								</table>
							</div>
						</div>
					</div>
					<div class="postbox">
						<h3><?php _e('Meistbesuchteste Links', 'izioseo') ?> (<?php _e('Top', 'izioseo') ?> <?php echo $nl ?>)</h3>
						<div class="inside">
							<div style="clear:both; margin:12px; text-align:justify;">
								<p>
									<?php _e('Anzahl festlegen', 'izioseo') ?>
									<a href="<?php if (!isset($_GET['nl'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nl=10<?php else : ?><?php echo str_replace('nl=' . $nl, 'nl=' . 10, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">10</a> |
									<a href="<?php if (!isset($_GET['nl'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nl=20<?php else : ?><?php echo str_replace('nl=' . $nl, 'nl=' . 20, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">20</a> |
									<a href="<?php if (!isset($_GET['nl'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nl=50<?php else : ?><?php echo str_replace('nl=' . $nl, 'nl=' . 50, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">50</a> |
									<a href="<?php if (!isset($_GET['nl'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;nl=100<?php else : ?><?php echo str_replace('nl=' . $nl, 'nl=' . 100, $_SERVER['REQUEST_URI']) ?><?php endif; ?>">100</a><br />
									<?php _e('Links downloaden als', 'izioseo') ?>
									<a href="<?php if (!isset($_GET['export'])) : ?><?php echo $_SERVER['REQUEST_URI'] ?>&amp;export=links-csv<?php else : ?><?php echo str_replace('export=' . $export, 'export=links-csv', $_SERVER['REQUEST_URI']) ?><?php endif; ?>"><?php _e('csv - Datei', 'izioseo') ?></a>
								</p>
								<table style="width:100%;">
									<?php foreach ($stats->getPopularLinks($nl) as $key => $link) : ?>
										<tr>
											<td style="width:18px;"><a href="<?php echo $link['link_url'] ?>"><img src="<?php echo $this->images ?>folder.png" alt="<?php _e('Link aufrufen', 'izioseo') ?>" height="16" width="16" /></a></td>
											<td style="margin-right: 12px;"><?php echo $this->truncate($link['link_url'], 60, 'h') ?></td>
											<td style="color:#21759b; font-size:18px; font-family:Georgia,Times New Roman,Bitstream Charter,Times,serif; text-align:right;"><?php echo $link['link_hits'] ?></td>
										</tr>
									<?php endforeach; ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
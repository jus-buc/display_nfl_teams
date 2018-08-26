<div class="container-fluid pl-0 pr-0">
	<h1 class="display-3">NFL Teams</h1>
	<div class="row">
		<?php
		$conferences = $nfl_plugin_object->get_Conferences();
		foreach ($conferences as $key => $conference) {
			?>
			<div class="col-sm">
				<h1 class="pb-2"><?php echo $conference->get_Name(); ?></h1>
				<?php
				$divisions = $conference->get_Divisions();
				foreach ($divisions as $key => $division) {
					?>
					<div class="pb-4">
	  					<h3><?php echo $division->get_Name(); ?></h3>
	  					<div class="card">
					  		<ul class="list-group list-group-flush">
								<?php
								$teams = $division->get_Teams();
								foreach ($teams as $key => $team) {
									?>
									<li class="list-group-item"><?php echo $team->get_Name(); ?></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
  	</div>
</div>
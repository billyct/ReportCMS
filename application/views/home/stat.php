
<div id="slideContainer">
	<div class="step" id="topic<?php echo $topic['id'] ?>">
		<div class="scrollbar">
			<div class="track">
				<div class="thumb">
					<div class="end"></div>
				</div>
			</div>
		</div>
		<div id="content" class="container viewport">
			<div class="overview">
				<div class="row-fluid">
					<div class="span8 offset1 clearfix">
						<h2 class="tpl"><?php echo $topic['name']?>结果统计</h2>
						<?php foreach ($stats as $stat) { ?>
							<div class="question" id="test">
								<h3>
									<?php
								      	switch ($stat['type']) {
									      	case 1:
									      		echo "单选题";
									      		break;
									      	case 2:
									      		echo "多选题";
									      		break;
									      	case 3:
									      		echo "判断题";
									      		break;
									      	case 4:
									      		echo "填空";
									      		break;
							      	}?>
									<span><?php echo $stat['title'] ?></span>
								</h3>


								<div class="skillContainer">
									<ul class="skill clearfix">
										<?php foreach ($stat['options'] as $option) { ?>
										<li>
											<span class="expand sk1" style="width:<?php echo $option['percent'] ?>;"></span> <em><?php echo $option['content'] ?></em>
											<span class="proc"><?php echo $option['percent'] ?></span>
										</li>
										<?php } ?>
									</ul>
								</div>

							</div>
						<?php } ?>



					</div>

				</div>
				<div class="row-fluid">
					<div class="span12 footer"></div>
				</div>
			</div>
		</div>
	</div>
</div>

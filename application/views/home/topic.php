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
					<div class="span10 offset1 clearfix">
						<h2 class="tpl"><?php echo $topic['name']?></h2>
						<?php foreach ($questions as $question) { ?>
							<div class="question">
								<h3>
									<?php
								      	switch ($question['type']) {
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
									<span><?php echo $question['title'] ?></span>
								</h3>
								<?php if($question['type'] == 3) { ?>
									<p>
										<select name="question<?php echo $question['id'] ?>">
											<option value="1" selected>是</option>
											<option value="0">否</option>
										</select>
									</p>
								<?php } ?>

								<?php if($question['type'] == 4) { ?>
									<p>
										<textarea name="question<?php echo $question['id'] ?>"></textarea>
									</p>
								<?php } ?>
								<?php foreach ($options[$question['id']] as $option) { ?>

									<?php if($question['type'] == 1) { ?>
									<label class="radio">
										<input type="radio" name="question<?php echo $question['id'] ?>" value="<?php echo $option['id'] ?>" />
										<?php echo $option['content'] ?>
									</label>
									<?php } ?>

									<?php if($question['type'] == 2) { ?>
									<label class="checkbox">
										<input type="checkbox" name="question<?php echo $question['id'] ?>" value="<?php echo $option['id'] ?>" />
										<?php echo $option['content'] ?>
									</label>
									<?php } ?>


								<?php } ?>

							</div>
						<?php } ?>

						<a href="#" class="btn" data="<?php echo $topic['id'] ?>" id="btn-submit-answer">提交</a>

					</div>

				</div>
				<div class="row-fluid">
					<div class="span12 footer"></div>
				</div>
			</div>
		</div>
	</div>

</div>

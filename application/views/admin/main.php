<?php include_once __DIR__.'/../layout/admin_header.php' ?>


<script id="topic_tr_tmpl" type="text/template">

    <li>
		<button type="button" data="{{=it.id}}" href="<?php echo base_url('admin/topic/delete_topic')?>" class="close delete_link">×</button>
		<a href="#topic_{{=it.id}}">{{=it.name}}</a>				  			
    </li>
</script>

<script id="question_tr_tmpl" type="text/template">
	<div id="question_{{=it.id}}">
	    <a class="close pull-right delete_link opacity9" rel="tooltip" title="删除问题" data="{{=it.id}}" href="<?php echo base_url('admin/question/delete_question')?>">&times;</a>
		{{ if ( it.type == 2 || it.type == 1) {}}
		<a class="pull-left" data-toggle="modal" data="{{=it.id}}" href="#add-option-modal" rel="tooltip" title="添加选项" id="add-option-modal-btn"><i class="icon-plus"></i></a>
		{{ } }}
		<blockquote>
			<p>
				<strong class="editable-title-textarea" rel="tooltip" title="双击修改">{{=it.title}}</strong>
				<small class="editable-type-select" rel="tooltip" title="双击修改">
					{{ if( it.type == 1){ }}
						单选题
					{{ }else if ( it.type == 2 ) {}}
						多选题
						{{ }else if (it.type == 3){ }}
						判断题 
					{{ } else if ( it.type == 4 ) { }} 
						填空 
					{{ } }}
			    </small>			    
			</p>
		</blockquote>
		<ol></ol>
	</div>
	<div class="clearfix"></div>
</script>

<script id="option_tr_tmpl" type="text/template">
    <li class="option-li">
	  	<section class="editable-option-textarea" rel="tooltip" title="双击修改" data="{{=it.id}}">{{=it.content}}</section>
	  	<a class="close delete_link pull-inherit opacity9" rel="tooltip" title="删除选项" data="{{=it.id}}" href="<?php echo base_url('admin/option/delete_option')?>">&times;</a>
		<div class="clearfix"></div>
	</li>
</script>




<div class="container">
	<div class="row">
		<div class="span2">
			<ul class="nav nav-list affix" id="nav-side">
			  <li class="active current_link"><a class="link_side" href="#div_questionnaire">问卷管理</a></li>
			  <li><a class="link_side" href="#div_stat">统计管理</a></li>
			</ul>
		</div>
		<div class="span10 div_href" id="div_questionnaire">
			<div class="row">
				<div class="span4">
					<form action="<?php echo base_url('admin/topic/add_topic') ?>" method="post" name="form_topic">
						<input type="text" name="topic_name" placeholder="主题名称" />
						<input type="submit" class="btn" id="btn_addtopic" name="btn_addtopic" value="添加主题" />
					</form>
				</div>


				<div class="span8">
					<ul class="nav nav-tabs" id="topic-tab">
					

					<?php foreach ($topics as $topic) { ?>
				  		<li>
				  			<button id="delete-topic" rel="tooltip" title="删除该主题" type="button" data="<?php echo $topic['id'] ?>" href="<?php echo base_url('admin/topic/delete_topic')?>" class="close opacity9 delete_link">×</button>
				  			<a href="#topic_<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></a>				  			
					    </li>
				  	<?php } ?>
				  	</ul>
					

				  	<!-- modals -->
					<div class="modal hide fade" id="add-question-modal">
					  <div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					    <h3>问题</h3>
					  </div>
					  <div class="modal-body">
					    <form action="<?php echo base_url('admin/question/add_question') ?>" method="post" name="form_question">
							<textarea name="question_title" placeholder="问题"></textarea>
							<br />
							<select name="question_type">
								<option value="1">单选题</option>
								<option value="2">多选题</option>
								<option value="3">判断题</option>
								<option value="4">填空</option>
							</select>
							<input type="hidden" name="topic_id" />
							<br />
							<input type="submit" class="btn" id="btn_addquestion" name="btn_addquestion" value="添加问题" />
						</form>
					  </div>
					</div>




					<div class="modal hide fade" id="add-option-modal">
					  	<div class="modal-header">
						    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						    <h3>选项</h3>
						</div>
						<div class="modal-body">
						    <form action="<?php echo base_url('admin/option/add_option') ?>" method="post" name="form_option">
								<textarea name="option_content" placeholder="选项内容"></textarea>
								<input type="hidden" name="question_id" />							
								<br />
								<input type="submit" class="btn" id="btn_addoption" name="btn_addoption" value="添加选项" />
							</form>
					  	</div>
					</div>

					<div class="tab-content">

						<?php foreach ($topics as $topic) { ?>
						    <div class="tab-pane" id="topic_<?php echo $topic['id'] ?>">


								<p>
									<div class="btn-toolbar">
  										<div class="btn-group">
											<a class="btn btn-primary" id="add-question-modal-btn" data="<?php echo $topic['id'] ?>" href="#add-question-modal" data-toggle="modal">
								    			<i class="icon-plus icon-white"></i> 添加问题
								    		</a>
								    		<a id="display-topic-btn" class="btn btn-primary" href="#" data="<?php echo $topic['id'] ?>">
								    			<i class="<?php echo ($topic['display'] == 0)?'icon-star-empty':'icon-star' ?> icon-white" data="<?php echo $topic['display'] ?>"></i> 前台显示
								    		</a>
								    	</div>
								    </div>
								</p>
								<div id="questions">
						    	<?php foreach ($questions as $question) { ?>
						    		<?php if($question['topic_id'] == $topic['id']) { ?>
						    		<div id="question_<?php echo $question['id'] ?>">
						    			<a class="opacity9 close pull-right delete_link" rel="tooltip" title="删除问题" data="<?php echo $question['id'] ?>" href="<?php echo base_url('admin/question/delete_question')?>">&times;</a>
							    		<?php if($question['type'] == 1 || $question['type'] == 2) {?>
							    		<a class="pull-left" data-toggle="modal" data="<?php echo $question['id'] ?>" href="#add-option-modal" rel="tooltip" title="添加选项" id="add-option-modal-btn"><i class="icon-plus"></i></a>
							    		<?php } ?>
							    		<blockquote>
							    			<p>
								    			<strong class="editable-title-textarea" rel="tooltip" title="双击修改" data="<?php echo $question['id'] ?>"><?php echo $question['title'] ?></strong>
								    			<small class="editable-type-select" rel="tooltip" title="双击修改" data="<?php echo $question['id'] ?>">

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
											    </small>
											    
											</p>
										</blockquote>

										<ol>
											<?php foreach ($options as $option) { ?>
												<?php if($option['question_id'] == $question['id']) { ?>
											      <li class="option-li">
											      	<section class="editable-option-textarea" rel="tooltip" title="双击修改" data="<?php echo $option['id'] ?>"><?php echo $option['content'] ?></section>
											      	
											      	<a class="opacity9 close delete_link pull-inherit" rel="tooltip" title="删除选项" data="<?php echo $option['id'] ?>" href="<?php echo base_url('admin/option/delete_option')?>">&times;</a>
											      	<div class="clearfix"></div>
											      </li>
											    <?php } ?>
										  	<?php } ?>
									  	</ol>

									</div>
									<div class="clearfix"></div>
						    		<?php } ?>
						    	<?php } ?>
						    	</div>
							</div>
				  		<?php } ?>

					</div>


				</div>
			</div>
		</div>

		<div class="span10 div_href" id="div_stat" style="display:none">
			<h1>统计管理</h1>
			<table class="table table-striped">
				<thead>
					<th>#</th>
					<th>ip地址</th>
					<th>提交问卷时间</th>
					<th>操作</th>
				</thead>
				<tbody>
					<?php foreach ($visitors as $visitor) { ?>
						<tr>
							<th>
								<?php echo $visitor['id'] ?>
							</th>
							<td>
								<?php echo $visitor['ip'] ?>
							</td>
							<td>
								<?php echo $visitor['create_at'] ?>
							</td>
							<td class="delete_link" data="<?php echo $visitor['id'] ?>" href="<?php echo base_url('admin/visitor/delete_visitor')?>">
								<a class="opacity9 close pull-inherit" rel="tooltip" title="删除提交者">&times;</a>
							</td>
						</tr>
					<?php } ?>
					
				</tbody>
			</table>
		</div>

	</div>

</div>



<?php include_once __DIR__.'/../layout/admin_footer.php' ?>
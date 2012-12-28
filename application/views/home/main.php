<?php include_once __DIR__.'/../layout/home_header.php' ?>

<div id="slideContainer">
    <div class="step" id="about">
        <div class="scrollbar">
            <div class="track">
                <div class="thumb">
                    <div class="end"></div>
                </div>
            </div>
        </div>
        <div class="container viewport" id="content">
            <div class="overview">
                <div class="row-fluid">
                    <div class="span3 offset1 doCenter">
                        <div class="simpleFrame">
                            <img src="<?php echo base_url('home_dir/images/content/about-me.jpg') ?>" width="200" alt=""></div>
                    </div>
                    <div class="span4">
                        <h2 class="hello">
                            <span>
                                Hello, I’m billyct
                                <br>
                                调查问卷的作业成果。</span>
                        </h2>
                        <p class="hi"></p>
                    </div>
                    <div class="span3">
                        <p class="myInfo">
                            <span class="u1">
                                <span class="name-icon"></span>
                            </span>
                            <span class="u2 first">billyct</span>
                        </p>
                        <p class="myInfo">
                            <span class="u1">
                                <span class="birth-icon"></span>
                            </span>
                            <span class="u2">1991-02-07</span>
                        </p>
                        <p class="myInfo">
                            <span class="u1">
                                <span class="place-icon"></span>
                            </span>
                            <span class="u2">
                                浙江中医院大学
                            </span>
                        </p>
                        <p class="myInfo">
                            <span class="u1">
                                <span class="mail-icon"></span>
                            </span>
                            <span class="u2">
                                <a href="mailto:billy_allen@126.com" class="norm">billy_allen@126.com</a>
                            </span>
                        </p>
                        <p class="myInfo">
                            <span class="u1">
                                <span class="tel-icon"></span>
                            </span>
                            <span class="u2">566664</span>
                        </p>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12 footer"></div>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($topics as $topic) { ?>
        <div class="step" id="topic<?php echo $topic['id'] ?>"></div>
    <?php } ?>
    
</div>

<?php include_once __DIR__.'/../layout/home_footer.php' ?>

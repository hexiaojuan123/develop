<extend name="public/base"/>
<block name="css">
    <style>
        .wdth {
            width: 47%;
        }

        .list {
            padding: 1px;
        }

        .panel-default:hover {
            color: #000;
            background-color: #fff;
            cursor: none;
        }

        .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
            color: #000000;
            background-color: #EAEAEA;
        }

        a {
            color: #000000;
            text-decoration: none;
            text-align: center;
        }
        .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus{
	        background-color: #000000;
            border-color: #676767;
        }
    </style>
</block>
<block name="main">
    <div class="row">
        <div style="position: absolute;right: 0.8em;top: 1em;"><a href="{:U('/Home/Register/index')}">提现</a></div>
        <div class="clearfix"></div>
        <h1 style="text-align: center;">我的佣金</h1>
        <ul class="nav nav-pills" role="tablist">
            <li role="presentation" class="active wdth pull-left"><a href="#home" aria-controls="home" role="tab"
                                                                     data-toggle="tab">可提现{$price}元</a>
            </li>
            <li role="presentation" class="wdth pull-right"><a id="tabed" href="#profile" aria-controls="profile" role="tab"
                                                               data-toggle="tab">已提现 0元</a></li>
            <li class="clearfix"></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">
                <h4 style="text-align:center">佣金明细</h4>
                <div class="panel panel-default">
                    <div class="panel-body" id="main">
                        <!--<volist name="list" id="vo" empty="没有数据">-->
                        <!--<div class="list">-->
                        <!--<div class="pull-left">-->
                        <!--<h4 style="margin: 0 auto;">{$vo['title']}-佣金</h4>-->
                        <!--<div class="pull-left"><small>{$vo['createtime']}</small></div>-->
                        <!--</div>-->
                        <!--<div class="pull-right"><h4>{$vo['commission']}元</h4></div>-->
                        <!--<div class="clearfix"></div>-->
                        <!--</div>-->
                        <!--<hr />-->
                        <!--</volist>-->
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="profile">
                <h4 style="text-align:center">提现明细</h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="mained"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="loadingToast" class="weui_loading_toast" style="display:none;">
        <div class="weui_mask_transparent" style="z-index:1041;"></div>
        <div class="weui_toast" style="z-index:1043;">
            <div class="weui_loading">
                <!-- :) -->
                <div class="weui_loading_leaf weui_loading_leaf_0"></div>
                <div class="weui_loading_leaf weui_loading_leaf_1"></div>
                <div class="weui_loading_leaf weui_loading_leaf_2"></div>
                <div class="weui_loading_leaf weui_loading_leaf_3"></div>
                <div class="weui_loading_leaf weui_loading_leaf_4"></div>
                <div class="weui_loading_leaf weui_loading_leaf_5"></div>
                <div class="weui_loading_leaf weui_loading_leaf_6"></div>
                <div class="weui_loading_leaf weui_loading_leaf_7"></div>
                <div class="weui_loading_leaf weui_loading_leaf_8"></div>
                <div class="weui_loading_leaf weui_loading_leaf_9"></div>
                <div class="weui_loading_leaf weui_loading_leaf_10"></div>
                <div class="weui_loading_leaf weui_loading_leaf_11"></div>
            </div>
            <p class="weui_toast_content">数据加载中</p>
        </div>
    </div>
</block>
<block name="js">
    <script>
    	var isfirstload=true;
        $(document).ready(function () {
            getwithdrewing(1);
            $('#tabed').click(function(){
               getwithdrewed(1);
               $(this).unbind('click');
             });
        });
        function getwithdrewing(index) {
            $.ajax({
                type: "post",
                url: "{:U('withdrewing')}",
                data: {'key': index},
                beforeSend: function () {
                    $('#loadingToast').show();
                },
                success: function (data) {
                    $('#main').fadeOut('fast', function () {
                        $(this).empty().html(data).fadeIn('fast');
                    });
                },
                complete:function () {
                    $('#loadingToast').hide();
                }
            });
        }
        function getwithdrewed(index) {
            $.ajax({
                type: "post",
                url: "{:U('withdrewed')}",
                data: {'key': index},
                beforeSend: function () {
                    $('#loadingToast').show();
                },
                success: function (data) {
                    $('#mained').fadeOut('fast', function () {
                        $(this).empty().html(data).fadeIn('fast');
                    });
                },
                complete:function () {
                    $('#loadingToast').hide();
                }
            });
        }
    </script>


</block>
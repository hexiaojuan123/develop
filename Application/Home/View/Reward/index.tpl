<extend name="public/base" />
<block name="css">
<style>
.wdth{
	width:47%;
}
</style>
</block>
<block name="main">
<div class="row">
<ul class="nav nav-pills" role="tablist">
    <li role="presentation" class="active wdth pull-left"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">可提现 80元</a></li>
    <li role="presentation" class="wdth pull-right"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">已提现 2400元</a></li>
    <li class="clearfix"></li>
</ul>
 <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">
    <h3 style="text-align:center">佣金明细</h3>
    <div class="panel panel-default">
  <div class="panel-body">
   <div class="list">
    <div class="pull-left">
    <h4 style="margin: 0 auto;">成交佣金收入</h4>
    <div class="pull-left"><small>2012-07-06 13:01</small></div>
    </div>
    <div class="pull-right"><h4>100元</h4></div>
    <div class="clearfix"></div>
   </div>
  </div>
</div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
    <h3 style="text-align:center">提现明细</h3>
        <div class="panel panel-default">
  <div class="panel-body">
   <div class="list">
    <div class="pull-left">
    <h4 style="margin: 0 auto;">提现佣金</h4>
    <div class="pull-left"><small>2016-07-06 13:01</small></div>
    </div>
    <div class="pull-right"><h4>90元</h4></div>
    <div class="clearfix"></div>
   </div>
  </div>
</div>
    </div>
    </div>
    </div>
</block>
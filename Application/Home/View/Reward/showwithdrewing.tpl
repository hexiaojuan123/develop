<volist name="list" id="vo" empty="没有数据">
   <div class="list">
    <div class="pull-left">
    <h4 style="margin: 0 auto;">{$vo['title']}-佣金</h4>
    <div class="pull-left"><small>{$vo['createtime']}</small></div>
    </div>
    <div class="pull-right"><h4>{$vo['commission']}元</h4></div>
    <div class="clearfix"></div>
   </div>
   <hr />
</volist>
{$apage}
    <!--<p>当前页：{$pagedata['index']} 共 {$pagedata['count']} 条数据 共 {$pagedata['pagecount']}</p>-->

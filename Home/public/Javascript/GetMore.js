/**
 * Created by ly on 16-3-8.
 */
var PAGE = 2;
function getMore(CLASS)
{
    var $url = '/index.php/Home/GetMore';
    var $type = 'post';
    var sync = true;
    var data = 'class='+CLASS+'&'+'page='+PAGE;
    var response_data = '';
    var ajax = getXmlHttpRequest();
    if(ajax){
        ajax.open($type,$url,sync);
        ajax.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        ajax.send(data);
        ajax.onreadystatechange = function(){
            if(ajax.readyState==4 && ajax.status === 200){
                response_data = ajax.responseText;
                if(response_data == 'false'){
                    alert('加载错误');
                }else if(response_data == 'null') {
                    alert('没有更多啦');
                }else{
                    deal_response(response_data);
                }
            }
        }
    }
}

function deal_response(res_data)
{
    var articles_data = JSON.parse(res_data);
    for(var i =0; i<articles_data.length; i++) {
        addNode(articles_data[0]);
    }
    PAGE++;
}

function addNode(a_data)
{
    var main_content = document.getElementById('main-content-right');

    var template =
        '<div class="content">'+
        '<div class="content-top" style="background-color:#{$vo.color};">'+
        '<h3 class="text-center">'+a_data.class[0]+'</h3>'+
        '<p class="text-center"><strong>'+a_data.time.substr(5)+'</strong></p>'+
        '</div>'+
        '<div class="content-body">'+
        '<p class="text-center content-title">'+
        '<a href="__APP__/Home/ShowArticle/index/id/{$vo.id}">'+a_data.title+'</a>'+
        '</p>'+
        '<div class="content-other">'+
        '<ul class="list-inline">'+
        '<li>'+
        '<h4>'+
        '<span class="glyphicon glyphicon-time" aria-hidden="true">时间：'+a_data.time+'</span>'+
        '</h4>'+
        '</li>'+
        '<li>'+
        '<h4>'+
        '<span class="glyphicon glyphicon-tag" aria-hidden="true">分类：'+a_data.time+'</span>'+
        '</h4>'+
        '</li>'+
        '</ul>'+
        '</div>'+
        '<p class="content-m"><strong>'+a_data.description+'</strong></p>'+
        '</div>'+
        '<div class="content-foot">'+
        '<ul class="list-inline">'+
        '<li>'+
        '<span class="glyphicon glyphicon-comment" aria-hidden="true">：<span class="label label-info" >*</span></span></li>'+
        '<li>'+
        '<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">：<span class="label label-warning">*</span></span></li>'+
        '<li>'+
        '<span class="glyphicon glyphicon-search" aria-hidden="true">：<span class="label label-success">'+a_data.read_sum+'</span></span></li>'+

        '</ul>'+
        '</div>'+
        '</div>';

    main_content.innerHTML+=template;

}
function getXmlHttpRequest() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject(); //IE5,6
    }
}

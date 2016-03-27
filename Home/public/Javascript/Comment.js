
var name;
var content;
function commitComment(id)
{
     name = document.getElementById("commentname").value;
     content = document.getElementById("commnetcontent").value;
    if(name == ""  ){
        alert("少侠给留个名吧");
        return false;
    }
    if(content == ""  ) {
        alert("总要要说点什么");
    }
    commit(id);
}

function commit(id)
{
    var $url = '/index.php/Home/DealComment';
    var $type = 'post';
    var sync = true;
    var data = 'name='+name+'&'+'content='+content+'&'+'id='+id;
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
                    alert('出错了，稍后在评论');
                }else{
                    addNode(response_data);
                    alert('留言成功');
                }
            }
        }
    }
}

function addNode(date)
{
    var comment = document.getElementById('comment');

    var template ='<div class="panel panel-default" style="margin-left:1em"><div class="panel-heading">'+
    '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>'+
    ':'+name+'&nbsp;&nbsp'+
    '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>:'+
        date+
    '&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-info btn-xs">回复</button></div><div class="panel-body">'+
    content+
    '</div></div>';
    comment.innerHTML=template+comment.innerHTML;

}
function getXmlHttpRequest() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject(); //IE5,6
    }
}

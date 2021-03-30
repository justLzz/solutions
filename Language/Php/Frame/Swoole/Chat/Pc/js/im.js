if(!/^http(s*):\/\//.test(location.href)){
  alert('请部署到localhost上查看该演示');
}
layui.use('layim', function(layim){
  //建立websoket
  var socket = new WebSocket('ws://192.168.107.7:9501/');
  
  var layim = layui.layim;
  layim.config({
    init: {
      //配置客户信息
      mine: {
        "username": "访客" //我的昵称
        ,"id": "10086" //我的ID
        ,"status": "online" //在线状态 online：在线、hide：隐身
        ,"remark": "在深邃的编码世界，做一枚轻盈的纸飞机" //我的签名
        ,"avatar": "./js/client.jpg" //我的头像
      }
    }
    //开启客服模式
    ,brief: true
  });
  //打开一个客服面板
  layim.chat({
    name: '图灵机器人' //名称
    ,type: 'kefu' //聊天类型
    ,avatar: './js/claim.jpg' //头像
    ,id: 10010 //定义唯一的id方便你处理信息
  });
  //layim.setChatMin(); //收缩聊天面板
  //监听发送消息
  layim.on('sendMessage', function(data){
    console.log(data);
    var mine = data.mine;
    layim.setChatStatus('<span style="color:#FF5722;">在线</span>');
    var obj = {
    		  username: mine.username,
	          avatar: mine.avatar,
	          id: mine.id,
	          type: '访客',
	          content: mine.content
    };
    socket.send(JSON.stringify(obj));
  });
  //连接成功时触发
  socket.onopen = function(){
	  console.log('访客连接成功'); 
  };
  //监听收到的消息
  socket.onmessage = function(res){
	  layim.getMessage({
		  username: '图灵机器人',
          avatar: './js/claim.jpg',
          id: 10010,
          type: 'kefu',
          content: res.data
	  });
  }; 
});
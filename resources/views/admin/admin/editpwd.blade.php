<div id="oop" style="width: 300px;margin:auto;margin-top: 10px;">
  <div class="form-group">
    <label for="phone">当前手机</label>
    <input type="text" id="curphone" class="form-control" id="phone" placeholder="请输入当前手机">
  </div>
  <div class="form-group" >
    <label for="code" style="display: block;">验证码</label>
    <input type="text" class="form-control" id="code" style="width: 200px;display: inline" placeholder="请输入验证码">
    <button style="" id="hqcode" class="btn btn-primary">获取验证码</button>
  </div>
  <div class="form-group">
    <label for="newpwd">新的密码</label>
    <input type="password" id="newpwd" class="form-control" placeholder="请输入新的密码">
  </div>
    <button id="okqd" style="margin-left: 36%;" type="submit" class="btn btn-danger">确定修改</button></div>



    <script type="text/javascript">
        var a;
        var out = null;
        if(a > 0){
            $('#hqcode').prop('disabled',true); 
        }else{
            var timea = null;
        }
        $('#hqcode').click(function(){
            $('#hqcode').prop('disabled',true); 
            var dqphone = $('#curphone').val();
            // var newpwd = $('#newpwd').val();
            // var code = $('#code').val();
            $.post("/admin/admin/" + id, {    
               "_token": csrf,
               "_method": "put",
               'dqphone':dqphone,
               // 'newpwd':newpwd,
               // 'code':code
            }, function(data) {
               if(data.code == '1'){
                        layui.use(['layer', 'form'], function(){
                          var layer = layui.layer
                          ,form = layui.form;
                          out = 0;
                          layer.msg('验证码发送成功');
                        });
               }else if(data.code == '0'){
                        layui.use(['layer', 'form'], function(){
                          var layer = layui.layer
                          ,form = layui.form;
                          out = 1;
                          layer.msg('您的手机号不正确');
                          $('#hqcode').prop('disabled',false); 
                        });
               }else if(data.code == '9'){
                        layui.use(['layer', 'form'], function(){
                          var layer = layui.layer
                          ,form = layui.form;
                          out = 1;
                          layer.msg('您已发送验证码，请不要重复发送');
                          $('#hqcode').prop('disabled',false); 
                        });
               }else{
                        layui.use(['layer', 'form'], function(){
                          var layer = layui.layer
                          ,form = layui.form;
                          out = 1;
                          layer.msg('发送失败');
                          $('#hqcode').prop('disabled',false); 
                        });
               }
            },'json');
            // $.ajaxSettings.async = true;
             setTimeout("pd()",1000);
            
        });
        function js()
        {
            if(a<1){
                $('#hqcode').prop('disabled',false); 
                $('#hqcode').html('获取验证码');
                clearInterval(timea);
                timea = null;
            }else{
                a -= 1;
                var txt = a + '秒可发送';
                $('#hqcode').html(txt);
                $('#hqcode').prop('disabled',true); 
            }
        }
        function pd()
        {
            if(out == 1){
                return false;
            }else if(out == null){
                layui.use(['layer', 'form'], function(){
                  var layer = layui.layer
                  ,form = layui.form;
                  out = null;
                  layer.msg('发送超时'); 
                });
                $('#hqcode').prop('disabled',false); 
                return false;
            }
            if(timea != null){
                return false;
            }else{
                a = 60;
                js();
                timea = setInterval('js()',1000);
            }
        }
    </script>
    <!-- 获取验证码结束 -->
    <!-- 点击确定修改执行 -->
    <script type="text/javascript">
        $('#okqd').click(function(){
            var dqphone = $('#curphone').val();
            var newpwd = $('#newpwd').val();
            var code = $('#code').val();
            var myreg= /^[1][3,4,5,7,8,9][0-9]{9}$/;
            if(!myreg.test(dqphone)){
                layui.use(['layer', 'form'], function(){
                      var layer = layui.layer
                      ,form = layui.form;
                      layer.msg('您的历史手机号格式填写不正确');
                });
                return false;
            }
            var pwd = /^[0-9a-zA-Z]{6,18}$/;
            if(!pwd.test(newpwd)){
                layui.use(['layer', 'form'], function(){
                      var layer = layui.layer
                      ,form = layui.form;
                      layer.msg('密码不可以使用特殊符号');
                });
                return false;
            }
            var codeyz= /^[0-9]{4}$/;
            if(!codeyz.test(code)){
                layui.use(['layer', 'form'], function(){
                      var layer = layui.layer
                      ,form = layui.form;
                      layer.msg('您的验证码格式不正确');
                });
                return false;
            }
            $.post("/admin/admin/editpwd/" + id, {    
               "_token": csrf,
               'dqphone':dqphone,
               'newpwd':newpwd,
               'code':code
            }, function(data) {
                if(data.code == 1){
                    $('#oop').html("<h1 style='margin:auto;'>密码修改成功</h1>");
                }else if(data.code == 2){
                    layui.use(['layer', 'form'], function(){
                      var layer = layui.layer
                      ,form = layui.form;
                      layer.msg('网络延迟，修改失败');
                    });
                }else if(data.code == 3){
                    layui.use(['layer', 'form'], function(){
                      var layer = layui.layer
                      ,form = layui.form;
                      layer.msg('您的验证码错误');
                    });
                }else if(data.code == 4){
                    layui.use(['layer', 'form'], function(){
                      var layer = layui.layer
                      ,form = layui.form;
                      layer.msg('您的当前手机号不正确');
                    });
                }

            },'json');

        });

    </script>
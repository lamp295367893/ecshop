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
    <label for="phone">修改邮箱</label>
    <input type="text" id="newemail" class="form-control" id="phone" placeholder="请输入您的邮箱">
  </div>
    <a id="okqd" style="margin-left: 36%;" type="submit" class="btn btn-danger">确定修改</a>
  </div>
    <!-- 点击获取验证码执行 -->
    <script type="text/javascript">
        var a;
        var out = null;
        if(a > 0){
            $('#hqcode').prop('disabled',true); 
        }else{
            var timea = null;
        }
        $('#editphone').html(phone);
        $('#hqcode').click(function(){
            $('#hqcode').prop('disabled',true); 
            var dqphone = $('#curphone').val();
            // var newemail = $('#newemail').val();
            // var code = $('#code').val();
            $.post("/grzx/sendcode/" + {{session('user.id')}}, {    
               "_token": "{{ csrf_token() }}",
               "_method": "put",
               'dqphone':dqphone,
               // 'newemail':newemail,
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
                          layer.msg('您的历史手机号不正确');
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
            var newemail = $('#newemail').val();
            var code = $('#code').val();
             $.post("/admin/sendemail/" + {{session('admin.id')}}, {    
               "_token": "{{ csrf_token() }}",
               'dqphone':dqphone,
               'newemail':newemail,
               'code':code
               // 'newemail':newemail,
               // 'code':code
            }, function(data) {
              
            },'json');
             layer.closeAll();
             layer.msg('验证邮件，发送成功');
        });
                  
    </script>
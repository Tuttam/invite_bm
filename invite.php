<?php
/**
 * FB Invite BM
 * @m0pfin
 */
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script language="JavaScript">
        $(document).ready(function(){
            $("#submit").click(function()
            {
                $("#erconts").fadeIn(5000);
                $.ajax(
                    {
                        type: "POST",
                        url: "invite_get.php", // Адрес обработчика
                        data: $("#callbacks").serialize(),
                        error:function()
                        {
                            $("#erconts").html("Произошла ошибка!");
                        },
                        beforeSend: function()
                        {
                            $("#erconts").html("Загрузка... <br><img src='assets/ajax-loader.gif'>");
                        },
                        success: function(result)
                        {
                            $("#erconts").html(result);
                            checkThis();
                        }
                    });
                return false;
            });
        });
    </script>
</head>

<body>
<style>
/* Demo Background */
body{background:url(https://cdn10.picryl.com/photo/2011/07/21/sts-131-eom-cf583d-1600.jpg)}

/* Form Style */
.form-horizontal{
    background: #fff;
    padding-bottom: 40px;
 border-radius: 15px;
 text-align: center;
}
.form-horizontal .heading{
    display: block;
    font-size: 35px;
 font-weight: 700;
 padding: 35px 0;
 border-bottom: 1px solid #f0f0f0;
 margin-bottom: 30px;
}
.form-horizontal .form-group{
    padding: 0 40px;
 margin: 0 0 25px 0;
 position: relative;
}
.form-horizontal .form-control{
    background: #f0f0f0;
    border: none;
    border-radius: 20px;
 box-shadow: none;
 padding: 0 20px 0 45px;
 height: 40px;
 transition: all 0.3s ease 0s;
}
.form-horizontal .form-control:focus{
    background: #e0e0e0;
    box-shadow: none;
 outline: 0 none;
}
.form-horizontal .form-group i{
    position: absolute;
    top: 12px;
 left: 60px;
 font-size: 17px;
 color: #c8c8c8;
 transition : all 0.5s ease 0s;
}
.form-horizontal .form-control:focus + i{
    color: #00b4ef;
}
.form-horizontal .fa-question-circle{
    display: inline-block;
    position: absolute;
    top: 12px;
 right: 60px;
 font-size: 20px;
 color: #808080;
 transition: all 0.5s ease 0s;
}
.form-horizontal .fa-question-circle:hover{
    color: #000;
}
.form-horizontal .main-checkbox{
    float: left;
    width: 20px;
 height: 20px;
 background: #11a3fc;
 border-radius: 50%;
 position: relative;
 margin: 5px 0 0 5px;
 border: 1px solid #11a3fc;
}
.form-horizontal .main-checkbox label{
    width: 20px;
 height: 20px;
 position: absolute;
 top: 0;
 left: 0;
 cursor: pointer;
}
.form-horizontal .main-checkbox label:after{
    content: "";
    width: 10px;
 height: 5px;
 position: absolute;
 top: 5px;
 left: 4px;
 border: 3px solid #fff;
 border-top: none;
 border-right: none;
 background: transparent;
 opacity: 0;
 -webkit-transform: rotate(-45deg);
 transform: rotate(-45deg);
}
.form-horizontal .main-checkbox input[type=checkbox]{
    visibility: hidden;
}
.form-horizontal .main-checkbox input[type=checkbox]:checked + label:after{
    opacity: 1;
}
.form-horizontal .text{
    float: left;
    margin-left: 7px;
 line-height: 20px;
 padding-top: 5px;
 text-transform: capitalize;
}
.form-horizontal .btn{
    float: right;
    font-size: 14px;
 color: #fff;
 background: #00b4ef;
 border-radius: 30px;
 padding: 10px 25px;
 border: none;
 text-transform: capitalize;
 transition: all 0.5s ease 0s;
}
@media only screen and (max-width: 479px){
    .form-horizontal .form-group{
        padding: 0 25px;
 }
 .form-horizontal .form-group i{
        left: 45px;
 }
 .form-horizontal .btn{
        padding: 10px 20px;
 }
}
</style>


<div class="container">
 <div class="row">

 <div class="col-md-offset-3 col-md-6">
     <!--div class="btn-group">
         <button type="button" class="btn btn-primary" onclick="document.location='check.php'">Mass check</button>
         <button type="button" class="btn btn-primary disabled">BM generate</button>
         <button type="button" class="btn btn-primary disabled">Invite BM</button>
     </div-->
 <form class="form-horizontal" name="MyForm" id="callbacks" action="" method="POST">
 <span class="heading">Invite BM<span class="badge badge-primary">v1.0</span></span>
 <div class="form-group">
 <input type="text" class="form-control" id="token" name="token" placeholder="Токен: Ads Manager">
 <i class="fa fa-user"></i>
 </div>

 <div class="form-group">
 <!--div class="main-checkbox">
 <input type="checkbox" value="none" id="checkbox1" name="check"/>
 <label for="checkbox1"></label>
 </div>
 <span class="text">Запомнить</span-->
    <button type="submit" class="btn btn-default" id="submit">Создать</button>


     <div class="col-md-offset-3 col-md-6" id="erconts" style = "display: none">
 </div>
 </form>
 </div>
     <div class="media">
         <div class="media-left media-middle">
             <a href="#">
                 <img class="media-object" src="..." alt="...">
             </a>
         </div>
         <div class="media-body">
            <font color="white">
                Telegram: <a href="#">@m0pfin</a>
            </font>
         </div>
     </div>
 </div></row>
</div></container>
</body>
</html>
<!-- Форма  -->
<div class="container">
	<div class="row">
<form role="form" method="POST" action=<?php echo ($_SESSION['fb_user'])? "/wall/mess" : "/facebook"; ?>>
  <div class="form-group col-md-10">
	  <textarea name="usermess"  class="form-control <?php echo ($_SESSION['fb_user'])? "" : "hidden"; ?>" rows="3" style="resize:none" autofocus placeholder="Enter a new message"><?php if($_POST['editval']!=''){echo $_POST['editmess'];} ?></textarea>
    <?php if($_POST['editval']!=''){echo '<input type="hidden" value="'.$_POST['editval'].'" name="edit_id">';} ?>
    <?php if($_POST['commentval']!=''){echo '<input type="hidden" value="'.$_POST['commentval'].'" name="comment_id">';} ?>
	  <textarea class="form-control <?php echo ($_SESSION['fb_user'])? "hidden" : ""; ?>" rows="2" style="resize:none" disabled placeholder="You can`t send messages until you log in"></textarea>
  </div>
  <button type="submit" class="btn btn-primary <?php echo ($_SESSION['fb_user'])? "" : "hidden"; ?>"> <?php if($_POST['editval']){echo 'Edit Message'; }elseif($_POST['commentval']){echo 'Send Commentary';} else{ echo 'Send Message'; } ?> </button>
  <button type="submit" class="btn btn-primary <?php echo ($_SESSION['fb_user'])? "hidden" : ""; ?>">Log in</button>
</form>
  </div>
</div>

<!-- Редирект  -->
<?php 
  if($data['redirect']!=''){
    echo '<script>window.location.replace("'.$data['redirect'].'")</script>';
  }
 ?>

<!-- Вывод сообщений  -->
<div class="container" style="padding-bottom:50px">
    <div class="row">
      <div class="col-md-12 img-rounded" style="background-color: #222; opacity:.9">
            
                <?php if(empty($data)): ; ?> 
                <h4 class="text-info" style="padding-left: 15px;">There are no messages yet! </h4>
                <?php endif; ?>
<!-- Функция вывода сообщений  -->  

<?php  drawMessages($data); ?>

      </div>
    </div>
</div>


<?php  

        function drawMessages($messArray){
          foreach ($messArray as $message) {       
            if($message['id']!=''): 

              ?>
<!--  Start print head -->
<div class="row img-rounded" style="padding: 5px; background-color: #222; opacity:.9">
  <div class="col-md-1">
    <img src=<?php echo '"'.$message['image'].'"'; ?> class="img-responsive img-circle" alt="Responsive image">
  </div>
    <div class="col-md-5">
      <h4 class="text-info"> <?php echo $message['name']; ?> </h4>
    </div>
      <div class="col-md-3">
        <p class="text-warning">Posted <?php echo $message['mess_time']; ?></p>
     </div>
      <?php if($message['mess_edited_time']!=''): ?> 
      <div class="col-md-3">
        <p class="text-warning">Edited <?php echo $message['mess_edited_time']; ?>
        </p>
      </div>
</div> <?php else: ?>  
</div> <?php endif; ?>

<!--  End Print Head -->
  <!--  Start print form with message -->
   <div class="row img-rounded" style="background-color: #333">
    <h5 class="text-warning" style="padding: 0 10px;"><?php echo nl2br($message['message']); ?>
    </h5>
      <!--  Start print buttons -->
      <!--  Commentary button -->
        <div class="col-md-3">
          <form action="/wall" method="POST">
            <input type="hidden" name="commentval" value=<?php echo '"'.$message['id'].':'.$message['mess_lvl'].'"'; ?>>
            <button type="submit" class="btn btn-link" name="comment">Commentary</button>
          </form>
        </div>
      <!--  Edit button -->
        <?php if($message['user_fbid']==$_SESSION['fb_user']['fb_id']): ?>
         <div class="col-md-3 col-md-offset-6">
            <form action="/wall" method="POST">
              <input type="hidden" name="editval" value=<?php echo '"'.$message['id'].':'.$message['user_id'].'"'; ?>>
              <input type="hidden" name="editmess" value=<?php echo '"'.$message['message'].'"'; ?>>
              <button type="submit" class="btn btn-link" name="edit">Edit</button>
            </form>
          </div>
      </div>
            <!--  Get commentaries -->       
          <?php if($message['parrents']) $checkFromComm = drawCommentary($message['parrents']); ?>
    
          <?php else: if($message['parrents']){ $checkFromComm = drawCommentary($message['parrents'])  ;}?>    
         <?php endif; endif; 

}}?>




 <?php function drawCommentary($commArray){
  foreach ($commArray as $comment) {
    if($comment['id']!=''): 
      ?>
      

<!--  Start print comments -->
<!--  Start print head -->
<!-- col-md-offset-<?php echo $comment['mess_lvl']; ?> В след блок -->
<div class="row img-rounded col-md-offset-<?php echo $comment['mess_lvl']; ?>" style="padding: 5px; background-color: #222; opacity:.9">
  <div class="col-md-1">
    <img src=<?php echo '"'.$comment['image'].'"'; ?> class="img-responsive img-circle" alt="Responsive image">
  </div>
    <div class="col-md-5">
      <h4 class="text-info"><?php echo $comment['name']; ?></h4>
    </div>
      <div class="col-md-3">
        <p class="text-warning">Posted <?php echo $comment['mess_time']; ?>
        </p>
      </div>
        <?php if($comment['mess_edited_time']!=''): ?> 
        <div class="col-md-3">
           <p class="text-warning">Edited <?php echo $comment['mess_edited_time'];  ?>
           </p>
        </div>
</div> <?php else: ?>
</div> <?php endif; ?>
       <!--  End Print Head -->
          <!--  Start print form with message -->
           <div class="row img-rounded row img-rounded col-md-offset-<?php echo $comment['mess_lvl']; ?>" style="background-color: #333">
           <h5 class="text-warning" style="padding: 0 10px;"><?php echo nl2br($comment['message']) ?>
           </h5>           
             <!--  Start print buttons -->
              <!--  Commentary button -->
          <div class="col-md-3">
              <form action="/wall" method="POST">
                <input type="hidden" name="commentval" value=<?php echo '"'.$comment['id'].':'.$comment['mess_lvl'].'"'; ?>>
                <button type="submit" class="btn btn-link" name="comment">Commentary</button>
              </form>
          </div>
           <!--  Edit button -->
           <?php if($comment['user_fbid']==$_SESSION['fb_user']['fb_id']): ?>
            <div class="col-md-3 col-md-offset-6">
              <form action="/wall" method="POST">
                <input type="hidden" name="editval" value=<?php echo '"'.$comment['id'].':'.$comment['user_id'].'"'; ?>>
                <input type="hidden" name="editmess" value=<?php echo '"'.$comment['message'].'"'; ?>>
                <button type="submit" class="btn btn-link" name="edit">Edit</button>
              </form>
            </div>

          </div> 
            <!--  Get commentaries --> 
        <?php if($comment['parrents']){drawCommentary($comment['parrents']);} ?>
        
            <?php else: if($comment['parrents']){drawCommentary($comment['parrents']);} ?>
        <?php endif; endif; 

}}?>


<!-- Иконки  -->
    <div class="backwrap gradient">
        <div class="back-shapes">
<em class="active epic-icon fa fa-comment-o floating" style="top:36.9727047146402%;left:12.36111111111111%;animation-delay:-2.5s;"></em>
<em class="active epic-icon fa fa-comment-o floating" style="top:77.66749379652606%;left:31.805555555555557%;animation-delay:-4.3s;"></em>
<em class="active epic-icon fa fa-comment-o floating" style="top:13.275434243176178%;left:68.81944444444444%;animation-delay:-3.65s;"></em>
<em class="active epic-icon fa fa-comment-o floating" style="top:35.732009925558316%;left:97.29166666666667%;animation-delay:-3.25s;"></em>
<em class="active epic-icon fa fa-comment-o floating" style="top:48.38709677419355%;left:50.208333333333336%;animation-delay:-2.65s;"></em>
<em class="active epic-icon fa fa-comment-o floating" style="top:1.1166253101736974%;left:4.236111111111111%;animation-delay:-1.55s;"></em>
<em class="active epic-icon fa fa-comments floating" style="top:83.00248138957816%;left:59.44444444444444%;animation-delay:-2s;"></em>
<em class="active epic-icon fa fa-comments floating" style="top:74.31761786600497%;left:79.93055555555556%;animation-delay:-1.15s;"></em>
<em class="active epic-icon fa fa-comments floating" style="top:5.955334987593052%;left:54.861111111111114%;animation-delay:-0.65s;"></em>
<em class="active epic-icon fa fa-comments floating" style="top:25.062034739454095%;left:30.34722222222222%;animation-delay:-0s;"></em>
<em class="active epic-icon fa fa-quote-left floating" style="top:70.96774193548387%;left:4.583333333333333%;animation-delay:-3.2s;"></em>
<em class="active epic-icon fa fa-quote-left floating" style="top:13.399503722084367%;left:42.15277777777778%;animation-delay:-2.4s;"></em>
<em class="active epic-icon fa fa-quote-right floating" style="top:47.022332506203476%;left:65.55555555555556%;animation-delay:-2s;"></em>
<em class="active epic-icon fa fa-quote-right floating" style="top:13.523573200992557%;left:92.5%;animation-delay:-1.6s;"></em>
<em class="active epic-icon fa fa-reddit-square floating" style="top:41.811414392059554%;left:-0.06944444444444445%;animation-delay:-3.1s;"></em>
<em class="active epic-icon fa fa-reddit-square floating" style="top:74.81389578163771%;left:29.09722222222222%;animation-delay:-2.6s;"></em>
<em class="active epic-icon fa fa-reddit-square floating" style="top:43.79652605459057%;left:51.388888888888886%;animation-delay:-1.8s;"></em>
<em class="active epic-icon fa fa-reddit-square floating" style="top:24.193548387096776%;left:81.18055555555556%;animation-delay:-0.5s;"></em>
<em class="active epic-icon fa fa-send-o floating" style="top:73.9454094292804%;left:21.875%;animation-delay:-4.95s;"></em>
<em class="active epic-icon fa fa-send-o floating" style="top:11.538461538461538%;left:23.680555555555557%;animation-delay:-4s;"></em>
<em class="active epic-icon fa fa-send-o floating" style="top:93.17617866004963%;left:60%;animation-delay:-2.95s;"></em>
<em class="active epic-icon fa fa-send-o floating" style="top:92.05955334987593%;left:86.18055555555556%;animation-delay:-2.4s;"></em>
<em class="active epic-icon fa fa-send-o floating" style="top:4.218362282878412%;left:71.59722222222223%;animation-delay:-1.5s;"></em>
<em class="active epic-icon fa fa-smile-o floating" style="top:55.33498759305211%;left:26.38888888888889%;animation-delay:-0.6s;"></em>
<em class="active epic-icon fa fa-smile-o floating" style="top:4.838709677419355%;left:86.94444444444444%;animation-delay:-4.35s;"></em>
<em class="active epic-icon fa fa-thumbs-o-up floating" style="top:83.87096774193549%;left:9.51388888888889%;animation-delay:-4.8s;"></em>
<em class="active epic-icon fa fa-thumbs-o-up floating" style="top:66.25310173697271%;left:44.236111111111114%;animation-delay:-4.35s;"></em>
<em class="active epic-icon fa fa-thumbs-o-up floating" style="top:89.70223325062035%;left:73.54166666666667%;animation-delay:-3.05s;"></em>
<em class="active epic-icon fa fa-thumbs-o-up floating" style="top:52.10918114143921%;left:83.125%;animation-delay:-2.8s;"></em>
<em class="active epic-icon fa fa-wechat floating" style="top:51.73697270471464%;left:23.333333333333332%;animation-delay:-3s;"></em>
<em class="active epic-icon fa fa-wechat floating" style="top:1.9851116625310175%;left:22.430555555555557%;animation-delay:-1.6s;"></em>
<em class="active epic-icon fa fa-wechat floating" style="top:34.49131513647643%;left:6.944444444444445%;animation-delay:-1.25s;"></em>
<em class="active epic-icon fa fa-wechat floating" style="top:40.44665012406948%;left:53.958333333333336%;animation-delay:-0.6s;"></em>
<em class="active epic-icon fa fa-wechat floating" style="top:82.5062034739454%;left:88.54166666666667%;animation-delay:-4.95s;"></em>
<em class="active epic-icon fa fa-wechat floating" style="top:77.04714640198512%;left:66.73611111111111%;animation-delay:-4.75s;"></em>
<em class="active epic-icon fa fa-user floating" style="top:77.41935483870968%;left:18.40277777777778%;animation-delay:-3.65s;"></em>
<em class="active epic-icon fa fa-user floating" style="top:45.6575682382134%;left:42.013888888888886%;animation-delay:-3.3s;"></em>
<em class="active epic-icon fa fa-user floating" style="top:44.168734491315135%;left:70.55555555555556%;animation-delay:-0.85s;"></em>
<em class="active epic-icon fa fa-user floating" style="top:7.816377171215881%;left:10.416666666666666%;animation-delay:-3.25s;"></em>
<em class="active epic-icon fa fa-comments-o floating" style="top:84.36724565756823%;left:64.02777777777777%;animation-delay:-2.6s;"></em>
<em class="active epic-icon fa fa-comments-o floating" style="top:-1.2406947890818858%;left:35.625%;animation-delay:-4.6s;"></em>
<em class="active epic-icon fa fa-drupal floating" style="top:33.7468982630273%;left:41.736111111111114%;animation-delay:-1.2s;"></em>
<em class="active epic-icon fa fa-drupal floating" style="top:36.47642679900744%;left:87.91666666666667%;animation-delay:-0.95s;"></em>
<em class="active epic-icon fa fa-drupal floating" style="top:83.37468982630273%;left:51.59722222222222%;animation-delay:-4.65s;"></em>
        </div>
    </div>
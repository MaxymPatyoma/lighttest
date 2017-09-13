<!-- Кнока логин\логаут  -->
<div class="container">
<div class="row">
<div class="col-md-2">
<a class="btn btn-primary btn-lg" href=<?php echo ($_SESSION['fb_user'])? "/facebook/logout" : '"'.$data['loginurl'].'"'; ?>> <i class="fa fa-facebook"></i> |  <?php echo ($_SESSION['fb_user'])? 'Log out!' : 'Log in with Facebook!'; ?></a>
</div>
</div>
</div>


<!-- Редирект  -->
<?php 
	if($data['redirect']!=''){
		echo '<script>window.location.replace("'.$data['redirect'].'")</script>';
	}?>



<!-- Иконки  -->
    <div class="backwrap gradient">
        <div class="back-shapes">
		<em class="active epic-icon fa fa-facebook-f floating" style="top:35.483870967741936%;left:7.222222222222222%;animation-delay:-4.1s;"></em>
<em class="active epic-icon fa fa-facebook-f floating" style="top:3.8461538461538463%;left:89.65277777777777%;animation-delay:-3.75s;"></em>
<em class="active epic-icon fa fa-facebook-f floating" style="top:66.25310173697271%;left:81.25%;animation-delay:-3.4s;"></em>
<em class="active epic-icon fa fa-facebook-f floating" style="top:82.38213399503722%;left:61.388888888888886%;animation-delay:-3.1s;"></em>
<em class="active epic-icon fa fa-facebook-f floating" style="top:4.590570719602978%;left:44.375%;animation-delay:-2.7s;"></em>
<em class="active epic-icon fa fa-facebook-f floating" style="top:50.62034739454094%;left:22.569444444444443%;animation-delay:-2.35s;"></em>
<em class="active epic-icon fa fa-facebook-f floating" style="top:76.1786600496278%;left:9.375%;animation-delay:-1.95s;"></em>
<em class="active epic-icon fa fa-facebook-f floating" style="top:2.4813895781637716%;left:6.25%;animation-delay:-1.55s;"></em>
<em class="active epic-icon fa fa-facebook-f floating" style="top:65.50868486352357%;left:60.27777777777778%;animation-delay:-1.2s;"></em>
<em class="active epic-icon fa fa-facebook-f floating" style="top:12.158808933002481%;left:70%;animation-delay:-0.9s;"></em>
<em class="active epic-icon fa fa-facebook-f floating" style="top:71.8362282878412%;left:92.63888888888889%;animation-delay:-0.5s;"></em>
<em class="active epic-icon fa fa-facebook-f floating" style="top:41.935483870967744%;left:39.236111111111114%;animation-delay:-0.2s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:5.086848635235732%;left:18.541666666666668%;animation-delay:-0.3s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:78.53598014888337%;left:41.25%;animation-delay:-0s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:55.08684863523573%;left:83.125%;animation-delay:-4.7s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:14.88833746898263%;left:97.56944444444444%;animation-delay:-4.3s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:7.94044665012407%;left:58.75%;animation-delay:-3.95s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:52.72952853598015%;left:55.55555555555556%;animation-delay:-3.65s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:87.22084367245658%;left:78.75%;animation-delay:-3.3s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:68.3622828784119%;left:35.763888888888886%;animation-delay:-2.95s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:83.99503722084367%;left:19.375%;animation-delay:-2.55s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:27.667493796526056%;left:36.736111111111114%;animation-delay:-2.2s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:36.22828784119107%;left:12.916666666666666%;animation-delay:-1.85s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:43.17617866004963%;left:66.80555555555556%;animation-delay:-0.65s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:25.682382133995038%;left:50%;animation-delay:-0.9s;"></em>
<em class="active epic-icon fa fa-facebook-square floating" style="top:31.885856079404466%;left:87.56944444444444%;animation-delay:-0s;"></em>
        </div>
    </div>


   

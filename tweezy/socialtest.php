<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$('#demo1').sharrre({
  share: {
    googlePlus: true,
    facebook: true,
    twitter: true
  },
  buttons: {
    googlePlus: {size: 'tall'},
    facebook: {layout: 'box_count'},
    twitter: {count: 'vertical', via: '_JulienH'}
  },
  hover: function(api, options){
    $(api.element).find('.buttons').show();
  },
  hide: function(api, options){
    $(api.element).find('.buttons').hide();
  },
  enableTracking: true
});

$('#share').sharrre({
  share: {
    googlePlus: true,
    facebook: true,
    twitter: true
  },
  url: 'http://gilventures.com/tweezy'
});

</script>

<style>
.sharrre .box{
  float:left;
}
.sharrre .count {
  color:#444444;
  display:block;
  font-size:17px;
  line-height:34px;
  height:34px;
  padding:4px 0;
  position:relative;
  text-align:center;
  text-decoration:none;
  width:50px;
  background-color:#eee;
  -webkit-border-radius:4px;
  -moz-border-radius:4px;
  border-radius:4px; 
}
.sharrre .share {
  color:#FFFFFF;
  display:block;
  font-size:11px;
  height:16px;
  line-height:16px;
  margin-top:3px;
  padding:0;
  text-align:center;
  text-decoration:none;
  width:50px;
  background-color:#9CCE39;
  -webkit-border-radius:4px;
  -moz-border-radius:4px;
  border-radius:4px; 
}
.sharrre .buttons {
  display:none;
  position:absolute;
  margin-left:50px;
  z-index:10;
  background-color:#fff;
}
.sharrre .button {
  float:left;
  max-width:50px;
  margin-left:10px;
}

</style>

</head>

<body>
<div id="demo1" data-url="http://sharrre.com" data-text="Make your sharing widget with Sharrre (jQuery Plugin)" data-title="share"></div>
</body>
</html>
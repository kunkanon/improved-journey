<div class="container">
  <div class="row">
      <div id="result">
      </div>
  </div>
</div>
<div id="pos-result"></div>
<script>
  $(document).ready(function(){
    var action = 'inactive';
    function loadMore(last_id){
      $.ajax({
          url: 'load.data.php?last_id=' + last_id,
          type: "get",
          dataType: 'json'
      }).done(function(data){
        $("#result").append(data['content']);
        if(data['status'] != 200){ 
            action = 'active'; 
        }else{ 
            action = 'inactive'; 
        }
      }).fail(function(jqXHR, ajaxOptions, thrownError){
          alert('server not responding...'+thrownError);
      });
    }
    if(action == 'inactive'){
          action = 'active';
          loadMore(0)
    }
    
    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#pos-result").height() && action == 'inactive')
      {
       action = 'active';
       var last_id = $(".data-rifa-id:last").attr("id");
       setTimeout(function(){
        loadMore(last_id);
       }, 1000);
      }
    });
});
</script>
?>

jQuery(document).ready(function(){
jQuery("#submit").click(function(){
    var name = jQuery("#dname").val();
jQuery.ajax({
type: 'POST',
url: MyAjax.ajaxurl,
data: {"action": "post_word_count", "dname":name},
success: function(html){
	
//alert(html);	
jQuery("#show").html(html);
}
});
});

});
jQuery(document).ready(function($){
	$(".spoiler").each(function(){
		sb_replace_content(this);
	});
	$(".spoiler").click(function(){
		/*
			TODO Fazer o bloco de spoiler fechar ;)
		*/
		//$(this).toggleClass("spoiler-open");
		if($(this).hasClass("spoiler")){
			$(this).fadeOut("slow", function(){
				$(this).removeClass("spoiler").addClass("spoiler-open");
				$(this).html($(this).attr("rel")).fadeIn("slow");
			});
		}
	});

});
function sb_replace_content(element){
	jQuery(element).attr("rel", jQuery(element).html());
	jQuery(element).html(spoiler_message);
}
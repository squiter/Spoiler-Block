(function() {
    tinymce.create('tinymce.plugins.spoiler', {
 
        init : function(ed, url){
            ed.addButton('spoiler', {
            title : 'Insert Spoiler',
			image: url + "/images/spoiler.png",
                onclick : function() {
                    ed.focus();
					ed.selection.setContent('<span class="spoiler">' + ed.selection.getContent() + '</span>');
                },
            });
        }
    });
 
    tinymce.PluginManager.add('spoiler', tinymce.plugins.spoiler);
 
})();
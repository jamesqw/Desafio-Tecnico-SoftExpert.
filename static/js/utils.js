Utils = {

	currentURL: window.location.href,

	getCurrentPathURL: function() {
		var me = this, url = me.currentURL;
		return url.split(url.substring(url.lastIndexOf("/")))[0];
	},

	tpl: function(context, id, cfg) {
		var me = this, partials = {};
		console.log(me.getCurrentPathURL());
		$.get(me.getCurrentPathURL() + '/static/template/' + id + '.html')
		.done(function(template) {
			var regex = template.match(/{{>(.*)}}/), partial = '';
			if (regex) {
				partial = regex.pop();
			}
			if (partial === id) {
				partials[id] = template;
			}
			return context.innerHTML = Mustache.render(template, cfg, partials);
		});
	}
}